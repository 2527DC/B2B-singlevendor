<?php

namespace Modules\Driver\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Driver\Entities\DriverOrders;
use Modules\Driver\Entities\Country;
use Modules\Driver\Entities\State;
use Modules\Driver\Entities\City;
use Modules\Driver\Entities\Order;
use Illuminate\Support\Facades\File;
use Modules\Driver\Repositories\DeliveryProcessRepository;
use Modules\Driver\Repositories\CancelReasonRepository;
use Modules\Driver\Services\OrderManageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
class DriverOrdersApiController extends Controller
{
   
    protected $ordermanageService;

    public function __construct(OrderManageService $ordermanageService)
    {
      
        $this->ordermanageService = $ordermanageService;
    }


    public function verifyOrderOtp(Request $request, int $orderId)
{
    $request->validate([
        'otp' => 'required|digits:4',
    ]);

    try {
        $order = Order::where('id', $orderId)
            ->where('otp', $request->otp)
            ->first();

        if (!$order) {
            Log::warning('Invalid order OTP attempt', [
                'order_id' => $orderId,
                'entered_otp' => $request->otp,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP',
            ], 422);
        }

        Log::info('Order OTP verified successfully', [
            'order_id' => $orderId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
        ], 200);

    } catch (\Throwable $e) {
        Log::error('Order OTP verification failed', [
            'order_id' => $orderId,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'OTP verification failed',
        ], 500);
    }
}



    
    public function generateAndSetOrderOtp(int $orderId)
    {
        try {
            $otp = random_int(1000, 9999);
    
            $order = Order::findOrFail($orderId);
            $order->otp = $otp;
            $order->save();
    
            Log::info('Order OTP generated', [
                'order_id' => $orderId
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'OTP generated successfully',
                
            ], 200);
    
        } catch (\Throwable $e) {
            Log::error('OTP generation failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate OTP'
            ], 500);
        }
    }
    

    public function driverOrders(Request $request)
    {
        try {
            // Validate request - allow seller_id to be a single integer or array of integers
            $request->validate([
                'order_date' => 'nullable|date',
                'seller_id'  => 'nullable', // Can be single integer or array
            ]);
    
            // Fetch CONFIRMED orders with pagination (30 per page)
            $orders = DriverOrders::with(['addressDetails', 'customer'])
                ->where('is_confirmed', 1) // Only get confirmed orders (is_confirmed = 1)
                ->where('driver_id', auth('sanctum')->id()) // Filter by logged-in driver
                ->when(
                    $request->filled('order_date'),
                    function ($query) use ($request) {
                        // Match ONLY assigned_date
                        $query->whereDate('assigned_date', $request->order_date);
                    }   
                )
                ->when(
                    $request->filled('seller_id'),
                    function ($query) use ($request) {
                        // Handle comma-separated string like "33,34,35" or single ID
                        $sellerIdInput = $request->seller_id;
                        
                        if (is_string($sellerIdInput) && strpos($sellerIdInput, ',') !== false) {
                            // Split comma-separated string into array
                            $sellerIds = array_map('trim', explode(',', $sellerIdInput));
                        } elseif (is_array($sellerIdInput)) {
                            // Already an array
                            $sellerIds = $sellerIdInput;
                        } else {
                            // Single ID
                            $sellerIds = [$sellerIdInput];
                        }
                        
                        $query->whereHas('packages', function ($q) use ($sellerIds) {
                            $q->whereIn('seller_id', $sellerIds);
                        });
                    }
                )
                ->orderBy('assigned_date', 'desc')
                ->paginate(30);
    
            // Transform orders
            $transformedOrders = $orders->map(function ($order) {
    
                $orderData = $order->toArray();
                $orderData['customer_coordinates'] = $order->customer ? $order->customer->coordinates : null;
                $addressDetails = $order->addressDetails;
    
                if (!$addressDetails) {
                    $orderData['address_details'] = null;
                    return $orderData;
                }
    
                $parseName = function ($nameJson) {
                    if (is_string($nameJson)) {
                        $decoded = json_decode($nameJson, true);
                        return $decoded['en'] ?? $nameJson;
                    }
                    return $nameJson;
                };
    
                // Shipping
                $shippingCountry = Country::find($addressDetails->shipping_country_id);
                $shippingState   = State::find($addressDetails->shipping_state_id);
                $shippingCity    = City::find($addressDetails->shipping_city_id);
    
                // Billing
                if ($addressDetails->bill_to_same_address == 1) {
                    $billingCountry = $shippingCountry;
                    $billingState   = $shippingState;
                    $billingCity    = $shippingCity;
                } else {
                    $billingCountry = Country::find($addressDetails->billing_country_id);
                    $billingState   = State::find($addressDetails->billing_state_id);
                    $billingCity    = City::find($addressDetails->billing_city_id);
                }
    
                $orderData['address_details'] = [
                    'id' => $addressDetails->id,
                    'order_id' => $addressDetails->order_id,
                    'customer_id' => $addressDetails->customer_id,
    
                    'shipping' => [
                        'name' => $addressDetails->shipping_name,
                        'email' => $addressDetails->shipping_email,
                        'phone' => $addressDetails->shipping_phone,
                        'address' => $addressDetails->shipping_address,
                        'country' => $shippingCountry ? [
                            'id' => $shippingCountry->id,
                            'code' => $shippingCountry->code,
                            'name' => $parseName($shippingCountry->name),
                            'phonecode' => $shippingCountry->phonecode,
                            'flag' => $shippingCountry->flag,
                        ] : null,
                        'state' => $shippingState ? [
                            'id' => $shippingState->id,
                            'name' => $parseName($shippingState->name),
                            'country_id' => $shippingState->country_id,
                        ] : null,
                        'city' => $shippingCity ? [
                            'id' => $shippingCity->id,
                            'name' => $parseName($shippingCity->name),
                            'state_id' => $shippingCity->state_id,
                        ] : null,
                        'postcode' => $addressDetails->shipping_postcode,
                    ],
    
                    'billing' => [
                        'same_as_shipping' => $addressDetails->bill_to_same_address == 1,
                        'name' => $addressDetails->billing_name,
                        'email' => $addressDetails->billing_email,
                        'phone' => $addressDetails->billing_phone,
                        'address' => $addressDetails->billing_address,
                        'country' => $billingCountry ? [
                            'id' => $billingCountry->id,
                            'code' => $billingCountry->code,
                            'name' => $parseName($billingCountry->name),
                            'phonecode' => $billingCountry->phonecode,
                            'flag' => $billingCountry->flag,
                        ] : null,
                        'state' => $billingState ? [
                            'id' => $billingState->id,
                            'name' => $parseName($billingState->name),
                            'country_id' => $billingState->country_id,
                        ] : null,
                        'city' => $billingCity ? [
                            'id' => $billingCity->id,
                            'name' => $parseName($billingCity->name),
                            'state_id' => $billingCity->state_id,
                        ] : null,
                        'postcode' => $addressDetails->billing_postcode,
                    ],
    
                    'created_at' => $addressDetails->created_at,
                    'updated_at' => $addressDetails->updated_at,
                ];
    
                return $orderData;
            });
    
            // Response
            return response()->json([
                'success' => true,
                'message' => 'Confirmed orders fetched successfully',
                'data' => [
                    'orders' => $transformedOrders,
                    'pagination' => [
                        'total' => $orders->total(),
                        'per_page' => $orders->perPage(),
                        'current_page' => $orders->currentPage(),
                        'last_page' => $orders->lastPage(),
                        'from' => $orders->firstItem(),
                        'to' => $orders->lastItem(),
                    ],
                ],
            ]);
    
        } catch (\Throwable $e) {
    
            Log::error('Error fetching confirmed orders', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip_address' => $request->ip(),
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching confirmed orders',
            ], 500);
        }
    }

    public function cancelledOrders(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'order_date' => 'nullable|date',
                'seller_id'  => 'nullable',
            ]);
    
            // Fetch CANCELLED orders with pagination (30 per page)
            $orders = DriverOrders::with(['addressDetails', 'customer'])
                ->where('is_cancelled', 1) // Only get cancelled orders
                ->where('driver_id', auth('sanctum')->id()) // Filter by logged-in driver
                ->when(
                    $request->filled('order_date'),
                    function ($query) use ($request) {
                        // Match ONLY assigned_date
                        $query->whereDate('assigned_date', $request->order_date);
                    }   
                )
                ->when(
                    $request->filled('seller_id'),
                    function ($query) use ($request) {
                        // Handle comma-separated string like "33,34,35" or single ID
                        $sellerIdInput = $request->seller_id;
                        
                        if (is_string($sellerIdInput) && strpos($sellerIdInput, ',') !== false) {
                            // Split comma-separated string into array
                            $sellerIds = array_map('trim', explode(',', $sellerIdInput));
                        } elseif (is_array($sellerIdInput)) {
                            // Already an array
                            $sellerIds = $sellerIdInput;
                        } else {
                            // Single ID
                            $sellerIds = [$sellerIdInput];
                        }
                        
                        $query->whereHas('packages', function ($q) use ($sellerIds) {
                            $q->whereIn('seller_id', $sellerIds);
                        });
                    }
                )
                ->orderBy('assigned_date', 'desc')
                ->paginate(30);
    
            // Transform orders (same as driverOrders method)
            $transformedOrders = $orders->map(function ($order) {
    
                $orderData = $order->toArray();
                $orderData['customer_coordinates'] = $order->customer ? $order->customer->coordinates : null;
                $addressDetails = $order->addressDetails;
    
                if (!$addressDetails) {
                    $orderData['address_details'] = null;
                    return $orderData;
                }
    
                $parseName = function ($nameJson) {
                    if (is_string($nameJson)) {
                        $decoded = json_decode($nameJson, true);
                        return $decoded['en'] ?? $nameJson;
                    }
                    return $nameJson;
                };
    
                // Shipping
                $shippingCountry = Country::find($addressDetails->shipping_country_id);
                $shippingState   = State::find($addressDetails->shipping_state_id);
                $shippingCity    = City::find($addressDetails->shipping_city_id);
    
                // Billing
                if ($addressDetails->bill_to_same_address == 1) {
                    $billingCountry = $shippingCountry;
                    $billingState   = $shippingState;
                    $billingCity    = $shippingCity;
                } else {
                    $billingCountry = Country::find($addressDetails->billing_country_id);
                    $billingState   = State::find($addressDetails->billing_state_id);
                    $billingCity    = City::find($addressDetails->billing_city_id);
                }
    
                $orderData['address_details'] = [
                    'id' => $addressDetails->id,
                    'order_id' => $addressDetails->order_id,
                    'customer_id' => $addressDetails->customer_id,
    
                    'shipping' => [
                        'name' => $addressDetails->shipping_name,
                        'email' => $addressDetails->shipping_email,
                        'phone' => $addressDetails->shipping_phone,
                        'address' => $addressDetails->shipping_address,
                        'country' => $shippingCountry ? [
                            'id' => $shippingCountry->id,
                            'code' => $shippingCountry->code,
                            'name' => $parseName($shippingCountry->name),
                            'phonecode' => $shippingCountry->phonecode,
                            'flag' => $shippingCountry->flag,
                        ] : null,
                        'state' => $shippingState ? [
                            'id' => $shippingState->id,
                            'name' => $parseName($shippingState->name),
                            'country_id' => $shippingState->country_id,
                        ] : null,
                        'city' => $shippingCity ? [
                            'id' => $shippingCity->id,
                            'name' => $parseName($shippingCity->name),
                            'state_id' => $shippingCity->state_id,
                        ] : null,
                        'postcode' => $addressDetails->shipping_postcode,
                    ],
    
                    'billing' => [
                        'same_as_shipping' => $addressDetails->bill_to_same_address == 1,
                        'name' => $addressDetails->billing_name,
                        'email' => $addressDetails->billing_email,
                        'phone' => $addressDetails->billing_phone,
                        'address' => $addressDetails->billing_address,
                        'country' => $billingCountry ? [
                            'id' => $billingCountry->id,
                            'code' => $billingCountry->code,
                            'name' => $parseName($billingCountry->name),
                            'phonecode' => $billingCountry->phonecode,
                            'flag' => $billingCountry->flag,
                        ] : null,
                        'state' => $billingState ? [
                            'id' => $billingState->id,
                            'name' => $parseName($billingState->name),
                            'country_id' => $billingState->country_id,
                        ] : null,
                        'city' => $billingCity ? [
                            'id' => $billingCity->id,
                            'name' => $parseName($billingCity->name),
                            'state_id' => $billingCity->state_id,
                        ] : null,
                        'postcode' => $addressDetails->billing_postcode,
                    ],
    
                    'created_at' => $addressDetails->created_at,
                    'updated_at' => $addressDetails->updated_at,
                ];
    
                return $orderData;
            });
    
            // Response
            return response()->json([
                'success' => true,
                'message' => 'Cancelled orders fetched successfully',
                'data' => [
                    'orders' => $transformedOrders,
                    'pagination' => [
                        'total' => $orders->total(),
                        'per_page' => $orders->perPage(),
                        'current_page' => $orders->currentPage(),
                        'last_page' => $orders->lastPage(),
                        'from' => $orders->firstItem(),
                        'to' => $orders->lastItem(),
                    ],
                ],
            ]);
    
        } catch (\Throwable $e) {
    
            Log::error('Error fetching cancelled orders', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip_address' => $request->ip(),
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching cancelled orders',
            ], 500);
        }
    }

public function getPhotoProof(Request $request)
{
    // Validate only file_name
    $request->validate([
        'file_name' => 'required|string',
    ]);

    // Base folder where files are stored
    $basePath = public_path('backend/photo_proof');

    // Full file path
    $fullPath = $basePath . '/' . $request->file_name;

    if (!File::exists($fullPath)) {
        return response()->json([
            'success' => false,
            'message' => 'File not found',
        ], 404);
    }

    // Return file directly
    return response()->file($fullPath);
}



    public function uploadPhotoProof(Request $request)
    {
        Log::info('uploadPhotoProof hit', [
            'has_file' => $request->hasFile('photo_proof'),
            'all_keys' => array_keys($request->all()),
            'order_number' => $request->order_number,
            'order_id' => $request->order_id,
        ]);

        $validator = Validator::make($request->all(), [
            'order_id'     => 'required',
            'order_number' => 'required|string',
            'photo_proof'  => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            Log::warning('uploadPhotoProof validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }
    
        $file = $request->file('photo_proof');
    
        // Destination path
        $destinationPath = public_path('backend/photo_proof');
    
        // Create folder if not exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
    
        // Custom filename
        $fileName =  $request->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
    
        // Move file
        $file->move($destinationPath, $fileName);
    
        return response()->json([
            'success' => true,
            'message' => 'Photo proof uploaded successfully',
            'data' => [
                'file_path' => 'backend/photo_proof/' . $fileName,
                'file_url'  => url('backend/photo_proof/' . $fileName),
            ],
        ]);
    }

    public function uploadSignatureProof(Request $request)
{
    $request->validate([
        'order_id'        => 'required',
        'order_number'    => 'required|string',
        'signature_proof' => 'required|string', // base64 data URL
    ]);

    $signatureData = $request->input('signature_proof');

    // Expected: data:image/png;base64,AAAA...
    if (strpos($signatureData, 'data:image') !== 0) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid signature data format',
        ], 422);
    }

    // Split metadata and base64 data
    [$meta, $content] = explode(',', $signatureData);

    // Detect extension from mime type
    $extension = 'png';
    if (str_contains($meta, 'image/jpeg') || str_contains($meta, 'image/jpg')) {
        $extension = 'jpg';
    }

    $decoded = base64_decode($content);

    if ($decoded === false) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to decode signature image',
        ], 422);
    }

    // Destination path
    $destinationPath = public_path('backend/signature_proof');

    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0755, true);
    }

    // Custom filename
    $fileName = $request->order_number . '_' . time() . '.' . $extension;
    $filePath = $destinationPath . DIRECTORY_SEPARATOR . $fileName;

    // Store file
    file_put_contents($filePath, $decoded);

    return response()->json([
        'success' => true,
        'message' => 'Signature proof uploaded successfully',
        'data' => [
            'file_path' => 'backend/signature_proof/' . $fileName,
            'file_url'  => url('backend/signature_proof/' . $fileName),
        ],
    ]);
}

public function orderDetails($id)
 {
    try {
        $order = $this->ordermanageService->findOrderByID($id);

        // Check if order exists and belongs to the driver
        if (!$order || $order->driver_id != auth('sanctum')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found or access denied',
            ], 404);
        }
        
        // Load the necessary relationships if not already loaded
        if (!$order->relationLoaded('packages')) {
            $order->load([
                'packages.products.seller_product_sku.sku.product',
                'packages.products.giftCard',
                'packages.seller',
                'packages.delivery_process',
                'packages.shipping',
                'address',
                'guest_info',
                'customer',
                'order_payment',
                'gift_card_uses',
                'affiliateUser.user',
                'coupon'
            ]);
        }
        
        // Determine order status
        $orderStatus = 'pending'; // default
        
        if ($order->is_cancelled == 1 && $order->is_paid == 0 && $order->is_confirmed == 0 && $order->is_completed == 0) {
            $orderStatus = 'cancelled';
        } elseif ($order->is_completed == 1 && $order->is_paid == 1 && $order->is_confirmed == 1) {
            $orderStatus = 'completed';
        } elseif ($order->is_confirmed == 1 && $order->is_paid == 0 && $order->is_completed == 0) {
            $orderStatus = 'pending';
        }
        
        $formattedOrder = [
            'order_details' => [
                'basic_info' => array_merge(
                    $order->only(['id', 'order_number', 'order_type', 'payment_type', 'grand_total', 'sub_total']),
                    [
                        'order_status' => $orderStatus,
                        'photo_proof_url' => $order->photo_proof ? url($order->photo_proof) : null,
                        'signature_proof_url' => $order->signature_proof ? url($order->signature_proof) : null,
                    ]
                ),
                'customer_info' => $order->customer ? [
                    'name' => $order->customer->first_name . ' ' . $order->customer->last_name,
                    'email' => $order->customer->email,
                    'phone' => $order->customer->phone,
                    'coordinates' => $order->customer->coordinates
                ] : ($order->guest_info ? [
                    'name' => $order->guest_info->shipping_name,
                    'email' => $order->guest_info->shipping_email,
                    'phone' => $order->guest_info->shipping_phone,
                    'coordinates' => null
                ] : null),
                'packages' => $order->packages->map(function($package) {
                    return [
                        'package_code' => $package->package_code,
                        'delivery_status' => $package->delivery_process ? $package->delivery_process->name : null,
                        'seller' => $package->seller ? [
                            'name' => $package->seller->first_name . ' ' . $package->seller->last_name,
                            'shop_name' => $package->seller->SellerAccount->seller_shop_display_name ?? null
                        ] : null,
        'products' => $package->products->map(function ($product) use ($package) {

            $sellerProductSkuId = $product->seller_product_sku->id ?? null;
            $sellerId = $package->seller->id ?? null;
            $price = $product->price;

            // ✅ Refund format: packageId-skuId-sellerId-price
            $refundProductKey = $package->id . '-' . $sellerProductSkuId . '-' . $sellerId . '-' . $price;

            $productData = [
                // Order product ID
                'order_product_id' => $product->id,

                // Seller Product SKU ID
                'product_sku_id' => $sellerProductSkuId,

                // Product ID
                'product_id' => $product->seller_product_sku->sku->product->id ?? null,

                // ✅ REQUIRED refund format
                'refund_product_key' => $refundProductKey,

                'type' => $product->type,
                'quantity' => $product->qty,
                'price' => $price,
                'tax_amount' => $product->tax_amount,
                'total' => ($price * $product->qty) + $product->tax_amount,
            ];

            if ($product->type === "gift_card") {
                $productData['name'] = $product->giftCard->name ?? null;
                $productData['thumbnail_image_source'] = $product->giftCard->thumbnail_image ?? null;
            } else {
                $productData['name'] =
                    $product->seller_product_sku->sku->product->product_name ?? null;

                $productData['thumbnail_image_source'] =
                    $product->seller_product_sku->sku->product->thumbnail_image_source ?? null;

                $productData['product_type'] =
                    $product->seller_product_sku->sku->product->product_type ?? null;

                $productData['model_number'] =
                    $product->seller_product_sku->sku->product->model_number ?? null;

                $productData['variations'] =
                    $product->seller_product_sku->product_variations ?? [];
            }

            return $productData;
        })


                    ];
                }),
                'payment_info' => $order->order_payment ? [
                    'amount' => $order->order_payment->amount,
                    'payment_method' => $order->GatewayName,
                    'transaction_id' => $order->order_payment->txn_id,
                    'date' => $order->order_payment->created_at
                ] : null,
                'summary' => [
                    'subtotal' => $order->sub_total,
                    'discount' => $order->discount_total,
                    'shipping' => $order->shipping_total,
                    'tax' => $order->tax_amount,
                    'grand_total' => $order->grand_total
                ]
            ]
        ];

        return response()->json([
            'success' => true,
            'message' => 'Order details fetched successfully',
            'data' => $formattedOrder
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Order not found',
            'error' => $e->getMessage()
        ], 404);
    }
}


public function salesInfoUpdateApi(Request $request, $id)
{
    Log::info('salesInfoUpdateApi called', [
        'order_id' => $id,
        'request_data' => $request->all(),
    ]);

    // Only pass what service expects
    $data = $request->only([
        'is_paid',
        'is_confirmed',
        'is_completed',
        'delivery_status',
        'cancel_reason_id',
        'note',
        'photo_proof',
        'signature_proof'
    ]);

    // Remove null values to avoid overwriting with null
    $data = array_filter($data, function($value) {
        return $value !== null;
    });

    // ✅ If order is completed, force delivery_status to Delivered (ID 5)
    if (isset($data['is_completed']) && $data['is_completed'] == 1) {
        $data['delivery_status'] = 5;
    }

    try {
        Log::info('Calling orderInfoUpdate service (API)', [
            'order_id' => $id,
            'payload' => $data,
        ]);

        $result = $this->ordermanageService->orderInfoUpdate($data, $id);

        Log::info('Order status updated successfully (API)', [
            'order_id' => $id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $data
        ], 200);

    } catch (\Exception $e) {
        Log::error('salesInfoUpdateApi exception', [
            'order_id' => $id,
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Operation failed: ' . $e->getMessage(),
        ], 500);
    }
}


}
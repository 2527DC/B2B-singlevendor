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
            $orders = DriverOrders::with('addressDetails')
                ->where('is_confirmed', 1) // Only get confirmed orders (is_confirmed = 1)
                ->where('driver_id', auth('sanctum')->id()) // Filter by logged-in driver
                ->when(
                    $request->filled('order_date'),
                    function ($query) use ($request) {
                        // Match ONLY created_at date
                        $query->whereDate('created_at', $request->order_date);
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
                ->orderBy('created_at', 'desc')
                ->paginate(30);
    
            // Transform orders
            $transformedOrders = $orders->map(function ($order) {
    
                $orderData = $order->toArray();
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
            $orders = DriverOrders::with('addressDetails')
                ->where('is_cancelled', 1) // Only get cancelled orders
                ->where('driver_id', auth('sanctum')->id()) // Filter by logged-in driver
                ->when(
                    $request->filled('order_date'),
                    function ($query) use ($request) {
                        // Match ONLY created_at date
                        $query->whereDate('created_at', $request->order_date);
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
                ->orderBy('created_at', 'desc')
                ->paginate(30);
    
            // Transform orders (same as driverOrders method)
            $transformedOrders = $orders->map(function ($order) {
    
                $orderData = $order->toArray();
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


}
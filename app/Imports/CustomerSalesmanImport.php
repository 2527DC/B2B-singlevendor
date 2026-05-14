<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Salesman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class CustomerSalesmanImport implements ToCollection, WithHeadingRow
{
    protected $sellerId;
    protected $stats = [
        'processed' => 0,
        'updated' => 0,
        'skipped' => 0,
    ];

    public function __construct($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    /**
     * Process the collection of rows from the Excel file.
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->stats['processed']++;

            $phoneNumber = isset($row['phone_number']) ? trim($row['phone_number']) : null;
            $salesmanId = isset($row['salesman_id']) ? trim($row['salesman_id']) : null;

            if (empty($phoneNumber) || empty($salesmanId)) {
                Log::info("Salesman Import: Row skipped due to missing data", ['phone' => $phoneNumber, 'salesman_id' => $salesmanId]);
                $this->stats['skipped']++;
                continue;
            }

            // Find the salesman to ensure it belongs to this seller
            $salesmanExists = Salesman::where('salesman_id', $salesmanId)
                ->where('seller_id', $this->sellerId)
                ->exists();

            if (!$salesmanExists) {
                Log::info("Salesman Import: Row skipped because salesman_id not found for this seller", ['salesman_id' => $salesmanId, 'seller_id' => $this->sellerId]);
                $this->stats['skipped']++;
                continue;
            }

            // Normalize phone for matching (last 10 digits)
            $cleanImportPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
            $normalizedImportPhone = substr($cleanImportPhone, -10);

            // Find the customer by phone number and ensure they belong to this seller's warehouse
            $user = User::where('warehouse_id', $this->sellerId)
                ->where(function($q) use ($phoneNumber, $normalizedImportPhone) {
                    $q->where('phone', $phoneNumber)
                      ->orWhere('phone', 'LIKE', '%' . $normalizedImportPhone);
                })
                ->first();

            if ($user) {
                $oldSalesmanId = $user->salesman_id;
                $updateStatus = $user->update(['salesman_id' => $salesmanId]);
                
                if ($updateStatus) {
                    Log::info("Salesman Import: SUCCESSFUL MAPPING", [
                        'customer_id' => $user->id,
                        'customer_name' => $user->first_name,
                        'phone' => $user->phone,
                        'old_salesman_id' => $oldSalesmanId,
                        'new_salesman_id' => $salesmanId,
                        'seller_id' => $this->sellerId
                    ]);
                    $this->stats['updated']++;
                } else {
                    Log::error("Salesman Import: FAILED TO UPDATE DATABASE", [
                        'customer_id' => $user->id,
                        'phone' => $user->phone,
                        'target_salesman_id' => $salesmanId
                    ]);
                    $this->stats['skipped']++;
                }
            } else {
                Log::info("Salesman Import: Row skipped because customer not found or warehouse mismatch", [
                    'import_phone' => $phoneNumber, 
                    'normalized' => $normalizedImportPhone,
                    'seller_id' => $this->sellerId
                ]);
                $this->stats['skipped']++;
            }
        }
    }

    /**
     * Get the import statistics.
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}

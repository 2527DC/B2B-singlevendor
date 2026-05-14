<?php

namespace App\Exports;

use App\Models\User;
use Modules\Customer\Entities\CustomerAddress;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerSalesmanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithCustomValueBinder
{
    protected $sellerId;

    public function __construct($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    /**
     * Get active customers belonging to this seller's warehouse.
     */
    public function collection()
    {
        return User::whereHas('role', function ($q) {
            $q->where('type', 'customer');
        })
        ->where('warehouse_id', $this->sellerId)
        ->where('is_active', 1)
        ->orderBy('first_name')
        ->get();
    }

    /**
     * Map each customer row.
     */
    public function map($user): array
    {
        // Get the customer's default shipping address for pincode
        $defaultAddress = CustomerAddress::where('customer_id', $user->id)
            ->where('is_shipping_default', 1)
            ->first();

        $pincode = $defaultAddress ? $defaultAddress->postal_code : '';

        // Store name from the user's store_name
        $storeName = $user->store_name ?? '';

        return [
            $user->first_name . ' ' . ($user->last_name ?? ''),
            $storeName,
            $user->phone ?? '',
            $pincode,
            $user->salesman_id ?? '',
        ];
    }

    /**
     * Column headers.
     */
    public function headings(): array
    {
        return [
            'Customer Name',
            'Store Name',
            'Phone Number',
            'Pincode',
            'Salesman ID',
        ];
    }

    /**
     * Style the header row.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Set column formats.
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * Bind value to cell, forcing string type for phone numbers.
     */
    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'C' && $cell->getRow() > 1) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
}

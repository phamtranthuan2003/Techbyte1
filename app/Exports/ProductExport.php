<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   $products = Product::all();

        return Product::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Image',
            'Description',
            'Provider ID',
            'Role',
            'Sell',
            'Created At',
            'Updated At',
            'product_code',
        ];
    }
}

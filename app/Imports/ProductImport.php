<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[0],
            'price' => $row[1],
            'image' => $row[2],
            'description' => $row[3],
            'provider_id' => $row[4],
            'category' => $row[5],
            'role' => $row[6],
            'sell' => $row[7],
        ]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportProductController extends Controller
{
    public function export() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
        Excel::store(new ProductExport, 'products.xlsx');
    }
}

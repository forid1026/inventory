<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function StockReport(){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id','asc')->get();
        return view('backend.stock_report.stock_report',compact('allData'));
    }

    public function StockReportPrint(){
        $allData = Product::orderBy('supplier_id', 'asc')->orderBy('category_id','asc')->get();
        return view('backend.report.stock_report_print',compact('allData'));
    }
}

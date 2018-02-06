<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Menuorder;
use Excel;
use App\Helper;

class ReportsController extends Controller
{

  public function index()
  {
    $reports = Order::where('status', '>=', 5)->orderBy('id','desc')->paginate(50);
    return view('report.reports')->withReports($reports);
  }


  public function reportDownload()
  {
    $reports = Order::join('tables', 'tables.id', '=', 'orders.table_id')
            ->select(
              'orders.id',  
              'tables.code', 
              'orders.payment_modes', 
              'orders.sub_total', 
              'orders.vat',
              'orders.discount',
              'orders.cash_received',
              'orders.status',
              'orders.net_total')
            ->where('orders.status', '>=', 5)
            ->get();


    $mpdf = new \Mpdf\Mpdf(['tempDir' => '/var/www/html/restaurant/']);
    $mpdf->WriteHTML(view('report.reportPdf')->withReports($reports));    
    $mpdf->Output('reports.pdf', 'I');

  }



  public function storeReports()
  {
    $item_to_update = Order::where('status', 5)->get();
    foreach($item_to_update as $item) {
        $updateTable = Order::find($item->id);
        $updateTable->status = 0;
        $updateTable->save();
    }

    return redirect()->back();
  }


  public function categoryWiseReport()
  {

    $categories = Menuorder::join('orders', 'orders.id', '=', 'menu_order.order_id')
                ->join('menus', 'menus.id', '=', 'menu_order.menu_id')
                ->join('categories', 'categories.id', '=', 'menus.category_id')
                ->where('orders.status','=', 5 )
                ->whereDate('orders.created_at','=', date('y-m-d'))
                ->select(
                  'categories.name', 
                  'menus.name as Menu'  
                  // 'menu_order.price'
                  // 'categories.id', 
                  // 'orders.created_at'
                )
                ->selectRaw('SUM(menu_order.quantity) as Quantity')
                ->selectRaw('menu_order.price')
                ->selectRaw('SUM(menu_order.quantity) * menu_order.price as Total')
                ->groupBy('menu_order.menu_id','orders.created_at')
                ->orderBy('categories.name')
                // ->where('orders.status', '>=', 5)
                ->get();


    $mpdf = new \Mpdf\Mpdf(['tempDir' => '/var/www/html/restaurant/']);
    $mpdf->WriteHTML(view('report.categoryReportPdf')->withCategories($categories));
    $mpdf->Output('categoryreports.pdf', 'I');

  }


}

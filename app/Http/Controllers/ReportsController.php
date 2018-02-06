<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Menuorder;
use Excel;
use App\Helper;
use Session;

class ReportsController extends Controller
{

  public function index()
  {
    $reports = Order::where('status', '>=', 5)->orderBy('id','desc')->paginate(50);
    return view('report.reports')->withReports($reports);
  }


  public function searchReport(Request $request)
  {

    $startdate = $request->from_date;
    $enddate = $request->to_date;

    if($startdate == '') {
      $startdate = date('Y-m-d');
    }
    if($enddate == '') {
      $enddate = date('Y-m-d');
    }

    $startdate = date('Y-m-d', strtotime($startdate));
    $enddate = date('Y-m-d', strtotime($enddate));

    Session::put('startdate',$startdate);
    Session::put('enddate',$enddate);

    $reports = Order::where('status', '>=', 5)->whereDate('created_at','>=',$startdate)->whereDate('created_at','<=',$enddate)->orderBy('id','desc')->paginate(50);
    
    return view('report.reports')->withReports($reports);
  }
  

  public function reportDownload()
  {

    $startdate = Session::get('startdate');
    $enddate = Session::get('enddate');

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
            ->whereDate('orders.created_at','>=',$startdate)
            ->whereDate('orders.created_at','<=',$enddate)
            ->orderBy('id','desc')
            ->get();

    $mpdf = new \Mpdf\Mpdf(['tempDir' => '/var/www/html/restaurant/']);
    $mpdf->WriteHTML(view('report.reportPdf')->withReports($reports));    
    $mpdf->Output('reports.pdf', 'I');

  }


  public function categoryWiseReport()
  {

    $startdate = Session::get('startdate');
    $enddate = Session::get('enddate');

    $categories = Menuorder::join('orders', 'orders.id', '=', 'menu_order.order_id')
                ->join('menus', 'menus.id', '=', 'menu_order.menu_id')
                ->join('categories', 'categories.id', '=', 'menus.category_id')
                ->where('orders.status','=', 5 )
                ->whereDate('orders.created_at','>=',$startdate)
                ->whereDate('orders.created_at','<=',$enddate)
                ->select(
                  'categories.name',
                  'menus.name as Menu'
                )
                ->selectRaw('SUM(menu_order.quantity) as Quantity')
                ->selectRaw('menu_order.price')
                ->selectRaw('SUM(menu_order.quantity) * menu_order.price as Total')
                ->groupBy('menu_order.menu_id')
                ->orderBy('categories.name')
                // ->where('orders.status', '>=', 5)
                ->get();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML(view('report.categoryReportPdf')->withCategories($categories));
    $mpdf->Output('categoryreports.pdf', 'I');

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


}

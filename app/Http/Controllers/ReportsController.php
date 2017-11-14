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
    $reports = Order::whereStatus(5)->orderBy('id','desc')->paginate(10);
    return view('report.reports')->withReports($reports);
  }


  public function reportDownload() {

    $reports = Order::join('tables', 'tables.id', '=', 'orders.table_id')
            ->select(
              'orders.id',  
              'tables.code', 
              'orders.payment_modes', 
              'orders.sub_total', 
              'orders.vat',
              'orders.discount',
              'orders.cash_received')
            ->where('orders.status', '>=', 5)
            ->get();


    // Initialize the array which will be passed into the Excel
    // generator.
    $paymentsArray = []; 

    // Define the Excel spreadsheet headers
    $paymentsArray[] = ['Serial No','Table Name','Payment Mode','Total Bill','Total Vat','Total Discount','Net Payable'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
     $total_cash = 0;
     $total_discount = 0;
     $total_vat = 0;
     $total_sub_total = 0;
     $i = 0;
      $s = 0; 
     $reportSummery = [];
    
    foreach ($reports as $report) {
        $s++;
        $ex_data = $report->toArray();    
        $ex_data['payment_modes'] = Helper::getPaymentModes()[$ex_data['payment_modes']];
        $paymentsArray[] = $ex_data;
        $total_cash += $report->cash_received;
        $total_discount += $report->discount;
        $total_vat += $report->vat;
        $total_sub_total += $report->sub_total;

        // $reportSummery = array();
        if(array_key_exists($ex_data['payment_modes'] , $reportSummery))
          {
            foreach ($reportSummery as $i => $val) {       
              if ($i == $ex_data['payment_modes']) {            
                $reportSummery[$i] = $reportSummery[$i] + $report->cash_received;          
              }
            }
          }
        else
          {
            $reportSummery[$ex_data['payment_modes']] = $report->cash_received; 
          }

        $i++;
    }

    $reportSummeryArray = array();
    $m=0;
    foreach($reportSummery as $ekey=>$eval)
    {
      $reportSummeryArray[]=array(0=>$ekey,1=>$eval);
      $m++;

    }
 //return $reportSummeryArray;

    $cel_no = 9 + $s + 1;
    $cel_no2 = 11 + $s + $m + 2;
    $cel_collection = 'C'.$cel_no2;
    $cel_collection_valu = 'D'.$cel_no2;
    $celGrand = $cel_no + 2;
    $celS = $cel_no + 3;
    $celHeading = 'C'.$celGrand;
    $celModes1 = 'C'.$celS;
    $celModes2 = 'C'.($celS+1);
    $celModes3 = 'C'.($celS+2);
    $celModes4 = 'C'.($celS+3);

    $celModes1_value = 'D'.$celS;
    $celModes2_value = 'D'.($celS+1);
    $celModes3_value = 'D'.($celS+2);
    $celModes4_value = 'D'.($celS+3);

    $celPlus = 'C'.$cel_no;
    $cel_no_vat = 'E'.$cel_no;
    $cel_no_discount = 'F'.$cel_no;
    $cel_no_sub_total = 'D'.$cel_no;
    $cel_no_total = 'G'.$cel_no;


    // Generate and return the spreadsheet
    Excel::create('DailyReport', function($excel) use ($paymentsArray, $cel_no_vat,$celPlus,$celHeading,$celModes1,$celModes2,$celModes3,$celModes4,$celModes1_value,$celModes2_value,$celModes3_value,$celModes4_value,$cel_collection,$cel_collection_valu,$reportSummeryArray,$cel_no_discount,$cel_no_sub_total,$cel_no_total,$total_cash,$total_discount,$total_vat,$total_sub_total) {        

      // Build the spreadsheet, passing in the payments array
      $excel->sheet('Daily Report', function($sheet) use ($paymentsArray, $cel_no_vat,$celPlus,$celHeading,$celModes1,$celModes2,$celModes3,$celModes4,$celModes1_value,$celModes2_value,$celModes3_value,$celModes4_value,$cel_collection,$cel_collection_valu,$reportSummeryArray,$cel_no_discount,$cel_no_sub_total,$cel_no_total,$total_cash,$total_discount,$total_vat,$total_sub_total) {
        $sheet->fromArray($paymentsArray, null, 'A9', false, false);
        

        $sheet->mergeCells('A1:G1', function($cells) {

        });
        $sheet->cell('A1', function($cell) {
            $cell->setValue('Falvours');
            $cell->setFontFamily('Times New Roman');
            $cell->setFontSize(16);
            $cell->setFontWeight('bold');
            $cell->setAlignment('center');
        });

        $sheet->mergeCells('A2:G2', function($cells) {

        });
        $sheet->cell('A2', function($cell) {
            $cell->setValue('Shaheb Bazar, Zero Point (2nd Floor of Bata Shop) Rajshahi');
            $cell->setFontFamily('Times New Roman');
            $cell->setAlignment('center');
        });

        $sheet->mergeCells('A3:G3', function($cells) {

        });
        $sheet->cell('A3', function($cell) {
            $cell->setValue('Contact Telephone : 772826, Mobile: 01713228276, 01713228278');
            $cell->setFontFamily('Times New Roman');
            $cell->setAlignment('center');
        });

        $sheet->mergeCells('A4:G4', function($cells) {

        });
        $sheet->cell('A4', function($cell) {
            $cell->setValue('VAT Registration No. : 12011059900');
            $cell->setFontFamily('Times New Roman');
            $cell->setFontWeight('bold');
            $cell->setAlignment('center');
        });

        $sheet->mergeCells('A5:B5', function($cells) {

        });
        $sheet->cell('A5', function($cell) {
            $cell->setValue('Current Date :');
            $cell->setFontFamily('Times New Roman');
            $cell->setFontWeight('bold');
        });

        $sheet->mergeCells('C5:G5', function($cells) {

        });
        $sheet->cell('C5', function($cell) {
            $cell->setValue(date('d-M-Y'));
        });
        
        $sheet->setBorder('A9:G9', 'thin');
        $sheet->cells('A9:G9', function($cells) {
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });

        $sheet->cell($celPlus, function($cell) {
          $cell->setValue('Grand Total :');
          $cell->setFontWeight('bold');
        });

        $sheet->cell($celHeading, function($cell) {
          $cell->setValue('Payments Mode');
          $cell->setFontWeight('bold');
        });
        
        $t = 1;
        foreach ($reportSummeryArray as $key => $value) {
        
          $val_0 = $value[0];
          $val_1 = $value[1];
          if ($t == 1)
          {
            $sheet->cells($celModes1, function($cells) use ($val_0) {
              $cells->setValue($val_0); 
              $cells->setFontWeight('bold');
              $cells->setAlignment('center');
              $cells->setFontFamily('Times New Roman');
            });

            $sheet->cells($celModes1_value, function($cells) use ($val_1) {
              $cells->setValue($val_1); 
              $cells->setFontWeight('bold');
              $cells->setAlignment('center');
              $cells->setFontFamily('Times New Roman');
            }); 
          }
          if ($t == 2)
          {
            $sheet->cells($celModes2, function($cells) use ($val_0) {
              $cells->setValue($val_0); 
              $cells->setFontWeight('bold');
              $cells->setAlignment('center');
              $cells->setFontFamily('Times New Roman');
            });

            $sheet->cells($celModes2_value, function($cells) use ($val_1) {
              $cells->setValue($val_1); 
              $cells->setFontWeight('bold');
              $cells->setAlignment('center');
              $cells->setFontFamily('Times New Roman');
            }); 
          }
        if ($t == 3)
          {
          $sheet->cells($celModes3, function($cells) use ($val_0) {
            $cells->setValue($val_0); 
            $cells->setFontWeight('bold');
            $cells->setAlignment('center');
            $cells->setFontFamily('Times New Roman');
          });

          $sheet->cells($celModes3_value, function($cells) use ($val_1) {
            $cells->setValue($val_1); 
            $cells->setFontWeight('bold');
            $cells->setAlignment('center');
            $cells->setFontFamily('Times New Roman');
          }); 
        }
        if ($t == 4)
          {
          $sheet->cells($celModes4, function($cells) use ($val_0) {
            $cells->setValue($val_0); 
            $cells->setFontWeight('bold');
            $cells->setAlignment('center');
            $cells->setFontFamily('Times New Roman');
          });

          $sheet->cells($celModes4_value, function($cells) use ($val_1) {
            $cells->setValue($val_1); 
            $cells->setFontWeight('bold');
            $cells->setAlignment('center');
            $cells->setFontFamily('Times New Roman');
          }); 
        }

        $t++;
        }
        
        $sheet->cells($cel_collection, function($cells) {
          $cells->setValue('Total Collection'); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });
        
        $sheet->cells($cel_collection_valu, function($cells) use ($total_cash) {
          $cells->setValue($total_cash); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });

        $sheet->cells($cel_no_sub_total, function($cells) use ($total_sub_total) {
          $cells->setValue($total_sub_total); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        }); 
        $sheet->cells($cel_no_vat, function($cells) use ($total_vat) {
          $cells->setValue($total_vat); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });
        $sheet->cells( $cel_no_discount, function($cells) use ($total_discount) {
          $cells->setValue($total_discount); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });

        $sheet->cells($cel_no_total, function($cells) use ($total_cash) {
          $cells->setValue($total_cash); 
          $cells->setFontWeight('bold');
          $cells->setAlignment('center');
          $cells->setFontFamily('Times New Roman');
        });

      });

    })->download('xlsx');
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



  public function categoryWiseReport() {

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


    // Initialize the array which will be passed into the Excel
    // generator.
    $categoriesArray = []; 

    // Define the Excel spreadsheet headers
    $categoriesArray[] = ['Category Name', 'Menu Name','Quantity','Price','Total'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.

    $totalQuantity = 0;
    $totalPrice = 0;
    $grandTotal = 0;
    $i = 0;
    foreach ($categories as $categorie) {
        $categoriesArray[] = $categorie->toArray();
        $totalQuantity += $categorie->Quantity;
        $totalPrice += $categorie->price;
        $grandTotal += $categorie->Total;

        $i++;
    }

    $cellPuls = 4 + $i + 1;
    $cellText = 'B'.$cellPuls;
    $cellQuantity = 'C'.$cellPuls;
    $cellPrice = 'D'.$cellPuls;
    $cellTotal = 'E'.$cellPuls;


    // Generate and return the spreadsheet
    Excel::create('CategoryWiseReport', function($excel) use ($categoriesArray,$totalQuantity,$totalPrice,$grandTotal,$cellText,$cellQuantity,$cellPrice,$cellTotal) {

      // Build the spreadsheet, passing in the payments array
      $excel->sheet('sheet1', function($sheet) use ($categoriesArray,$totalQuantity,$totalPrice,$grandTotal,$cellText,$cellQuantity,$cellPrice,$cellTotal) {
          $sheet->fromArray($categoriesArray, null, 'A4', false, false);

          $sheet->mergeCells('A1:E1', function($cells) {

          });
          $sheet->cell('A1', function($cell) {
              $cell->setValue('Falvours');
              $cell->setFontFamily('Times New Roman');
              $cell->setFontSize(16);
              $cell->setFontWeight('bold');
              $cell->setAlignment('center');
          });

          $sheet->mergeCells('A2:B2', function($cells) {

          });
          $sheet->cell('A2', function($cell) {
              $cell->setValue('Item Wise Sales Report :');
              $cell->setFontFamily('Times New Roman');
              $cell->setFontWeight('bold');
          });

          $sheet->mergeCells('C2:E2', function($cells) {

          });
          $sheet->cell('C2', function($cell) {
              $cell->setValue(date('d-M-Y'));
              $cell->setFontWeight('bold');
          });

          $sheet->cells('A4:E4', function($cells) {
            $cells->setFontWeight('bold');
            $cells->setAlignment('center');
            $cells->setFontFamily('Times New Roman');
          });

          $sheet->cell($cellText, function($cell) {
              $cell->setValue('Grand Total :');
              $cell->setFontWeight('bold');
          });
          $sheet->cell($cellQuantity, function($cell) use ($totalQuantity) {
              $cell->setValue($totalQuantity);
              $cell->setFontWeight('bold');
          });
          $sheet->cell($cellPrice, function($cell) use ($totalPrice) {
              $cell->setValue($totalPrice);
              $cell->setFontWeight('bold');
          });
          $sheet->cell($cellTotal, function($cell) use ($grandTotal) {
              $cell->setValue($grandTotal);
              $cell->setFontWeight('bold');
          });

      });

    })->download('xlsx');
  }


}

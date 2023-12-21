<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){      
     
         $monthly = date('Y-m');            
         $tot_problem = DB::connection('sqlsrv')
                  ->select("SELECT (select count(cust_po) FROM problemfound
                            where convert(nvarchar(50), created_at,126) LIKE '%$monthly%')as total_problem");

         
        $tot_borrow_unclear = DB::connection('sqlsrv')
                    ->select("SELECT (select count(custpo) FROM borrow
                                    where convert(nvarchar(50), created_at,126) LIKE '%$monthly%'
                                    and qty != tot_return
                                      )as total_borrow_unclear 
                              ");


          $tot_borrow_clear = DB::connection('sqlsrv')
                  ->select("SELECT (select count(custpo) FROM borrow
                                  where convert(nvarchar(50), created_at,126) LIKE '%$monthly%'
                                  and qty = tot_return
                                    )as total_borrow_clear 
                            ");

        
          $total_shipping = DB::connection('sqlsrv')
                      ->select("SELECT (select count(distinct a.prodno) from tbl_invoice as a
									inner join schedule as  b on a.prodno = b.prodno
                                    where
                                          convert(nvarchar(50), b.vandate,126) LIKE'%$monthly%') as total_shipping
                            ");


         $dataproblem = DB::connection('sqlsrv')
                      ->select("SELECT a.*, b.* from problemfound as b
                                inner join finishgood_list as a on a.partno = b.part_no and a.custpo = b.cust_po
                                where convert(nvarchar(50), b.created_at,126) LIKE '%$monthly%' ");
                        
      

         $databorrow = DB::connection('sqlsrv')
                      ->select(" SELECT * from borrow                                    
                                     where convert(nvarchar(50), created_at,126) LIKE '%$monthly%'
                                     and qty != tot_return
                            ");

                      
         $history_borrow = DB::connection('sqlsrv')
                    ->select(" 	SELECT * from borrow
                                where qty = tot_return
                                and
                                convert(nvarchar(50), created_at,126) LIKE '%$monthly%'
                              ");


          $datashipping = DB::connection('sqlsrv')
                    ->select(" 	SELECT  
                                      a.custcode,a.dest,a.model,a.prodno           
                                      ,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem    
                                  
                                        ,f.invoice_no
                                      from schedule as a
                                          left join partlist as b on a.prodno = b.prodno and b.demand = a.demand
                                          left join finishgood_list as c on a.prodno = c.prodno  and c.demand = a.demand
                                          left join inhouse_list as d on a.prodno = d.lotno and d.shipqty = a.demand
                                          --left join borrow as e on a.prodno = e.prodno
                                          inner join tbl_invoice as f on a.prodno = f.prodno
                                          --where f.invoice_no = null and a.prodno = f.prodno
                                where convert(nvarchar(50), a.vandate,126) LIKE '%$monthly%'
                                      group by
                                          a.custcode,a.dest,a.model,a.prodno,a.jkeipodate,a.vandate,a.etd,a.eta,a.shipvia,a.orderitem
                                        ,f.invoice_no,b.prodno
                                        order by max(a.vandate)
                              ");
        
        return view('dashboardMenu.index',
                    compact('tot_problem','tot_borrow_unclear','tot_borrow_clear','total_shipping','dataproblem','databorrow','monthly','history_borrow','datashipping'));
    }
}

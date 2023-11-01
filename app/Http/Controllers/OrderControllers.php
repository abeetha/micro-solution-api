<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderControllers extends Controller
{

  protected OrderService $orderService;
  public function __construct(OrderService $orderService)
  {
    $this->orderService = $orderService;
  }


  // save Order
  public function saveOrder(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'Customer_PO' => 'required|string|max:191',
      'MIS_PO' => 'required|string|max:191',
      'replacement_quote' => 'required|string|max:191',
      'quotation' => 'required|string|max:191',
      'SLA_reference_no' => 'required|string|max:191',
      'contact_no' => 'required|string|max:191',
      'Inv_No' => 'required|string|max:191',
      'Inv_Date' => 'required|string|max:191',
      'supplier' => 'required|string|max:191',
      'supplier_inv_no' => 'required|string|max:191',
      'remote' => 'required|string|max:191',
      'onsite' => 'required|string|max:191',
      'per_visit' => 'required|string|max:191',
      'ext' => 'required|string|max:191',
      'MIS' => 'required|string|max:191',
      'remark' => 'required|string|max:191',

    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!"
      ], 500);
    } else {
      $result = $this->orderService->save($request);
    }
    return ($result);
  }



  // save setImageOrder
  public function setImageOrder(Request $request, int $order_id)
  {

    $validator1 = Validator::make($request->all(), [
      'document' => 'required',
    ]);
    $validator2 = Validator::make($request->all(), [
      'hardCopy' => 'required',
    ]);
    $validator3 = Validator::make($request->all(), [
      'softCopy' => 'required',
    ]);

    if ($validator1->fails() && $validator2->fails() && $validator3->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!"
      ], 500);
    } else{
      $result2 = $this->orderService->setImageOrder($request, $order_id);
      return ($result2);
    }
  }




  // getAll Order
  public function getAllData()
  {
    $usersDetails = DB::table('customer')
      ->join('orders', 'customer.cust_id', '=', 'orders.cust_id')
      ->join('devices', 'orders.order_id', '=', 'devices.order_id')
      ->select('orders.*', 'devices.*', 'customer.cust_name')
      ->get();

    return response()->json($usersDetails,200);
  }




  // Search Order
  public function searchOrderbyId(int $id)
  {
    $usersDetails = DB::table('orders')
    ->join('orders', 'customer.cust_id', '=', 'orders.cust_id')
    ->join('devices', 'orders.order_id', '=', 'devices.order_id')
    ->select('orders.*', 'devices.*', 'customer.cust_name')
    ->where('orders.order_id', '=',$id)
    ->get();

  return response()->json($usersDetails,200);
  }

}

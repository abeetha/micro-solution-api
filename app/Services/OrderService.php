<?php

namespace App\Services;

use App\Models\ContactPerson;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class OrderService
{

  public function save(Request $request)
  {

    $customerId = $request->input('cust_id');
    $email = $request->input('email');

    $customer = Customer::where('cust_id', $customerId)
      ->orWhere('email', $email)
      ->first();


    // customer-found and order save
    if ($customer) {
      $order = new Order();
      $order->Cust_id = $request->Cust_id;
      $order->Customer_PO = $request->Customer_PO;
      $order->MIS_PO = $request->MIS_PO;
      $order->replacement_quote = $request->replacement_quote;
      $order->quotation = $request->quotation;
      $order->SLA_reference_no = $request->SLA_reference_no;
      $order->contact_no = $request->contact_no;
      $order->Inv_No = $request->Inv_No;
      $order->Inv_Date = $request->Inv_Date;
      $order->supplier = $request->supplier;
      $order->supplier_inv_no = $request->supplier_inv_no;
      $order->remote = $request->remote;
      $order->onsite = $request->onsite;
      $order->per_visit = $request->per_visit;
      $order->ext = $request->ext;
      $order->MIS = $request->MIS;
      $order->remark = $request->remark;
      $order->save();

      foreach ($request->device as $value) {
        $device = new Device();
        $device->order_id = $order->order_id;
        $device->brand = $value['brand'];
        $device->part_No = $value['part_No'];
        $device->serial_No = $value['serial_No'];
        $device->description = $value['description'];
        $device->location = $value['location'];
        $device->ms_support_startDate = $value['ms_support_startDate'];
        $device->ms_support_endDate = $value['ms_support_endDate'];
        $device->contract_startDate = $value['contract_startDate'];
        $device->contract_endDate = $value['contract_endDate'];
        $device->contract_renewalDate = $value['contract_renewalDate'];
        $device->support_endLastDate = $value['support_endLastDate'];
        $device->preventive_maintennanceDate = $value['preventive_maintennanceDate'];

        $order->device()->save($device);
      }

      $order->device = $request->device;
      return response()->json($order, 201);


      //customer-not-found and order save
    } else {
      $customer = new Customer();
      $customer->cust_name = $request->cust_name;
      $customer->cust_contact = $request->cust_contact;
      $customer->email = $request->email;
      $customer->address = $request->address;
      $customer->status =  $request->status;
      $customer->save();
      foreach ($request->contactPerson as $value) {
        $conperson = new ContactPerson();
        $conperson->cust_id = $customer->cust_id;
        $conperson->contactPerson_name = $value['contactPerson_name'];
        $conperson->contactPerson_contact = $value['contactPerson_contact'];
        $customer->contactperson()->save($conperson);
      }
      $customer->contactPerson = $request->contactPerson;

      $order = new Order();
      $order->Cust_id = $request->Cust_id;
      $order->Customer_PO = $request->Customer_PO;
      $order->MIS_PO = $request->MIS_PO;
      $order->replacement_quote = $request->replacement_quote;
      $order->quotation = $request->quotation;
      $order->SLA_reference_no = $request->SLA_reference_no;
      $order->contact_no = $request->contact_no;
      $order->Inv_No = $request->Inv_No;
      $order->Inv_Date = $request->Inv_Date;
      $order->supplier = $request->supplier;
      $order->supplier_inv_no = $request->supplier_inv_no;
      $order->remote = $request->remote;
      $order->onsite = $request->onsite;
      $order->per_visit = $request->per_visit;
      $order->ext = $request->ext;
      $order->MIS = $request->MIS;
      $order->remark = $request->remark;
      $order->save();

      foreach ($request->device as $value) {
        $device = new Device();
        $device->order_id = $order->order_id;
        $device->brand = $value['brand'];
        $device->part_No = $value['part_No'];
        $device->serial_No = $value['serial_No'];
        $device->description = $value['description'];
        $device->location = $value['location'];
        $device->ms_support_startDate = $value['ms_support_startDate'];
        $device->ms_support_endDate = $value['ms_support_endDate'];
        $device->contract_startDate = $value['contract_startDate'];
        $device->contract_endDate = $value['contract_endDate'];
        $device->contract_renewalDate = $value['contract_renewalDate'];
        $device->support_endLastDate = $value['support_endLastDate'];
        $device->preventive_maintennanceDate = $value['preventive_maintennanceDate'];

        $order->device()->save($device);
      }

      $order->device = $request->device;
      return response()->json($order, 201);
    }
  }


  // save setImageOrder
  public function setImageOrder(Request $request, $id)
  {
    $orders = Order::where('order_id', 'LIKE', '%' . $id . '%')
      ->get();

    $count = 0;
    if (!$request->document == null) {
      $count = 1;
      $new_image1 = "bg-" . time() . '.' . $request->document->extension();
      DB::table('orders')
        ->where('order_id', $id)
        ->update(
          [
            'document' => $new_image1
          ]
        );
    }

    if (!$request->hardCopy == null) {
      $count = 1;
      $new_image2 = "bg-" . time() . '.' . $request->hardCopy->extension();
      DB::table('orders')
        ->where('order_id', $id)
        ->update(
          [
            'hardCopy' => $new_image2
          ]
        );
    }


    if (!$request->softCopy == null) {
      $count = 1;
      $new_image3 = "bg-" . time() . '.' . $request->softCopy->extension();
      DB::table('orders')
        ->where('order_id', $id)
        ->update(
          [
            'softCopy' => $new_image3
          ]
        );
    }

    if ($count == 1) {
      return response()->json('image Updated Seccessfully', 200);
    } else {
      return response()->json('image not Updated');
    }
  }
}

<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ContactPerson;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function save(Request $request)
    {
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
        $conperson->contactPerson_name=$value['contactPerson_name'];
        $conperson->contactPerson_contact=$value['contactPerson_contact'];
        $customer->contactperson()->save($conperson);
      }
        $customer->contactPerson = $request->contactPerson;
        return ($customer);
    }  

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->cust_name = $request->cust_name;
        $customer->cust_contact= $request->cust_contact;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();
        $customer->contactPerson = $request->contactPerson;
        return ($customer);
    }
}

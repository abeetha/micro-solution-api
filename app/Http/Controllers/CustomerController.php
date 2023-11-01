<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
  protected CustomerService $customerService;


  public function __construct(CustomerService $CustomerService)
  {
    $this->customerService = $CustomerService;
  }
  public function index()
  {
    $customers = Customer::with('contactperson')->get();
    return ($customers);
  }
  public function search(string $input): JsonResponse
  {
    $customer = Customer::with('contactperson')
      ->where('cust_id', 'LIKE', '%' . $input . '%')
      ->orWhere('cust_name', 'LIKE', '%' . $input . '%')
      ->orWhere('cust_contact', 'LIKE', '%' . $input . '%')
      ->orWhere('email', 'LIKE', '%' . $input . '%')
      ->orWhere('address', 'LIKE', '%' . $input . '%')
      ->get();
    return response()->json($customer, 201);
  }
  public function save(Request $request)
  {
    dd('ok');
    $validator = Validator::make($request->all(), [
      'cust_name' => 'required|string|max:191',
      'cust_contact' => 'required|string|max:191',
      'email' => 'required|string|max:191',
      'address' => 'required|string|max:191',
      'status' => 'required|string|max:191',
      'contactPerson.*.contactPerson_name' => 'required|string|max:191',
      'contactPerson.*.contactPerson_contact' => 'required|string|max:191'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!"
      ], 500);
    } else {
      $result = $this->customerService->save($request);
    }
    return ($result);
  }
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'cust_name' => 'required|string|max:191',
      'cust_contact' => 'required|string|max:191',
      'email' => 'required|string|max:191',
      'address' => 'required|string|max:191',
      'status' => 'required|string|max:191',
      'contactPerson.*.contactPerson_name' => 'required|string|max:191',
      'contactPerson.*.contactPerson_contact' => 'required|string|max:191'
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 500,
        'message' => "Something Went Wrong!"
      ], 500);
    } else {
      $result = $this->customerService->update($request, $id);
    }
    return ($result);
  }
  public function delete(int $id)
  {
    $customer = Customer::find($id);
    $customer->delete();
    return ($customer);
  }
}

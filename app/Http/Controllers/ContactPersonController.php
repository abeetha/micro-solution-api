<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactPerson;
use App\Http\Controllers\Controller;
use App\Services\ContactPersonService;

class ContactPersonController extends Controller
{
  protected ContactPersonService $contactpersonservice;

  public function __construct(ContactPersonService $ContactPersonService)
  {
    $this->contactpersonservice = $ContactPersonService;
  }

  public function index()
  {
    $conpersons = ContactPerson::all();
    return ($conpersons);
  }

  public function save(Request $request)
  {
    $request->validate([
      'contactPerson_name' => 'required|string|max:191',
      'contactPerson_contact' => 'required|string|max:191'
    ]);

    $result = $this->contactpersonservice->save($request);

    return ($result);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'contactPerson_name' => 'required|string|max:191',
      'contactPerson_contact' => 'required|string|max:191'
    ]);

    $result = $this->contactpersonservice->update($request, $id);

    return ($result);
  }
}

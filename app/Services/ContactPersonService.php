<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ContactPerson;


class ContactPersonService
{
    public function save(Request $request)
    {
     
    }  

    public function update(Request $request, $id)
    {
        $conperson = ContactPerson::find($id);
        $conperson->contactPerson_name = $request->contactPerson_name ;
        $conperson->contactPerson_contact = $request->contactPerson_contact ;
        $conperson->save();
        return ($conperson);

    }
}

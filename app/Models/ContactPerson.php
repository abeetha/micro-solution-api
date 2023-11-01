<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = "contactperson";

    protected $primaryKey = 'contactPerson_id';

    protected $fillable = [
      'contactPerson_name',
      'contactPerson_contact'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id');
    }
}

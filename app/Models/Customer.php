<?php

namespace App\Models;

use App\Models\ContactPerson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";

    
    protected $primaryKey = 'cust_id';

    protected $fillable = [
        'cust_name',
        'cust_contact',
        'email',
        'address',
        'status',
    ];

    public function contactperson()
    {
        return $this->hasMany(ContactPerson::class,'cust_id');
    }

   
}

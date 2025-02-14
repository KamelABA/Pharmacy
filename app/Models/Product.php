<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int'; // تأكيد أنه int

    protected $fillable = ['name', 'description', 'quantity', 'price', 'images', 'type'];
}



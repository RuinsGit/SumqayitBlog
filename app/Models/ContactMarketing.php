<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMarketing extends Model
{
    use HasFactory;

    protected $table = 'contact_marketing';
    protected $fillable = ['name', 'email', 'message'];
}


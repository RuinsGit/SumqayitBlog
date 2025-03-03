<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';

    protected $fillable = [
        'name',
        'email',
        'number',
        'text',
        'status',
    ];
} 
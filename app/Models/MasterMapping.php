<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMapping extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name'];
}

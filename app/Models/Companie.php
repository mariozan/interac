<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = ["name", "email", "logo", "website"];
}

<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    use HasFactory;

    protected $fillable = [
        'power_id', 'status', 'onofftime',
    ];
    public $timestamps = false; 
    // laravel database migration has default columns called “updated_at” and “created_at”, if we don’t want such data column, set public $timestamp in Models to false would work.
}
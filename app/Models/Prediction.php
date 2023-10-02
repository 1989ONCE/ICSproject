<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
 
class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_on',
        'pred_ph',
        'fk_model_id',
    ];
    
    public $timestamps = false; 
}
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
        'T01_2_pre_drug', 
        'T01_4_pre_drug',
        'T01_5_pre_drug1',
        'T01_5_pre_drug2',
        'T01_6_pre_drug',
        'T01_12_pre_drug1',
        'T01_12_pre_drug2',
        'T01_13_pre_drug',
        'T01_15_pre_cod',
        'fk_model_id',
    ];
    
    public $timestamps = false; 
}
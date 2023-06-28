<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
 
class Datas extends Model
{
    use HasFactory;

    protected $fillable = [
        'T01_2_drug', 
        'T01_4_ph', 
        'T01_4_drug',
        'T01_5_ph',
        'T01_5_drug1',
        'T01_5_drug2',
        'T01_6_drug',
        'T01_12_ph',
        'T01_12_drug1',
        'T01_12_drug2',
        'T01_13_drug',
        'T01_15_ph',
        'T01_15_temp',
        'T01_15_ec',
        'T01_15_cod',
        'added_on',
    ];
    public $timestamps = false; 
}
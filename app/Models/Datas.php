<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
 
class Datas extends Model
{
    use HasFactory;

    protected $fillable = [
        'T01_6_ph',
        'T01_6_ss',
        'T01_12_ph',
        'T01_14_ph',
        'T01_12_drug1_current',
        'T01_12_drug2_current',
        'added_on',
    ];
    public $timestamps = false; 
}
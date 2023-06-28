<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
 
class Testdatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'testdata_id', 'added_on', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data6', 'data7', 'data8', 'data9', 'data10'
    ];
    public $timestamps = false; 
}
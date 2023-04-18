<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
 
class Datas extends Model
{
    use HasFactory;

    public function pool(): HasOne
    {
        // Data HasOne pool Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(Pool::class, 'pool_id', 'fk_pool_id');
    }

    protected $fillable = [
        'data_id', 'ph', 'temp', 'EC', 'COD', 'SS', 'add_on', 'fk_pool_id',
    ];
    public $timestamps = false; 
}
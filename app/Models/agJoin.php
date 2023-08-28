<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
 
class agJoin extends Model
{
    use HasFactory;

    public function alarm(): HasOne
    {
        // agJoin HasOne alarm Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(Alarm::class, 'alarm_id', 'fk_alarm_id');
    }

    public function group(): HasOne
    {
        // agJoin HasOne group Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(Group::class, 'group_id', 'fk_group_id');
    }

    public function user(): HasOne
    {
        // agJoin HasMany agUser Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(User::class, 'id', 'fk_user_id');
    }

    protected $fillable = [
        'ag_join_id', 'ag_join_name', 'fk_alarm_id', 'fk_group_id', 'fk_user_id',
    ];
    public $timestamps = false; 
}
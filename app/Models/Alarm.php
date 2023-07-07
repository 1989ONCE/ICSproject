<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Alarm extends Model
{
    use HasFactory;

    public function agJoin(): BelongsTo
    {
        // Alarm BelongsTo agJoin Method: $this->belongsTo(連結的表, '外來鍵名稱');
        return $this->belongsTo(agJoin::class, 'fk_alarm_id', 'alarm_id');
    }

    public function notify(): HasOne
    {
        // Alarm HasOne notify Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(Notify::class, 'notify_id', 'fk_notify_id');
    }

    protected $fillable = [
        'alarm_id', 'alarm_name', 'alarm_type', 'operator', 'alarm_num', 'fk_notify_id',
    ];
    public $timestamps = false; 
    // laravel database migration has default columns called “updated_at” and “created_at”, if we don’t want such data column, set public $timestamp in Models to false would work.
}
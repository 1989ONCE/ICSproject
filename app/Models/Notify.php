<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alarm;

class Notify extends Model
{
    use HasFactory;

    public function alarm(): BelongsTo
    {
        // notify BelongsTo alarm Method: $this->belongsTo(連結的表, '外來鍵名稱', 'ref id欄位名稱');
        return $this->belongsTo(Alarm::class, 'fk_notify_id', 'notify_id');
    }

    protected $fillable = [
        'notify_id', 'method'
    ];
    public $timestamps = false; 
    // laravel database migration has default columns called “updated_at” and “created_at”, if we don’t want such data column, set public $timestamp in Models to false would work.
}
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Pool extends Model
{
    use HasFactory;

    public function data(): BelongsTo
    {
        // Pool BelongsTo data Method: $this->belongsTo(連結的表, '外來鍵名稱');
        return $this->belongsTo(Data::class, 'fk_group_id');
    }

    protected $fillable = [
        'pool_id', 'pool_name'
    ];
    public $timestamps = false; 
    // laravel database migration has default columns called “updated_at” and “created_at”, if we don’t want such data column, set public $timestamp in Models to false would work.
}
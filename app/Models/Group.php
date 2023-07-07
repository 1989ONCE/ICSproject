<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Group extends Model
{
    use HasFactory;

    public function agJoin(): BelongsTo
    {
        // Group BelongsTo agJoin Method: $this->belongsTo(連結的表, '外來鍵名稱');
        return $this->belongsTo(agJoin::class, 'fk_group_id');
    }

    public function user(): BelongsTo
    {
        // Group BelongsTo User Method: $this->belongsTo(連結的表, '外來鍵名稱');
        return $this->belongsTo(User::class, 'fk_group_id', 'group_id');
    }

    protected $fillable = [
        'group_id', 'group_name'
    ];
    public $timestamps = false; 
    // laravel database migration has default columns called “updated_at” and “created_at”, if we don’t want such data column, set public $timestamp in Models to false would work.
}
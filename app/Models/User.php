<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function agJoin(): BelongsToMany
    {
        // agUser BelongsTo agJoin Method: $this->belongsTo(連結的表, '外來鍵名稱');
        return $this->belongsToMany(agJoin::class, 'fk_user_id');
    }

    public function group(): HasOne
    {
        // User HasOne Group Method: $this->hasOne(ref的表, '要ref的欄位名稱', '外來鍵名稱');
        return $this->hasOne(Group::class, 'group_id', 'fk_group_id');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'password',
        'fk_group_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

 
/*   class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
 
    // ...
}
*/
?>
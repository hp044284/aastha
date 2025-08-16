<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded  = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
        static::creating(function ($role)
        {
            $role->username = self::Generate_Unique_Random_Id();
            $role->random_id = self::Generate_Unique_Random_Id();
        });
    }

    private static function Generate_Unique_Random_Id()
    {
        $randomId = strtoupper('US'.date('ym').Str::random(4));
        while (self::where('random_id', $randomId)->exists())
        {
            $randomId = strtoupper('US'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function Is_Super_Admin()
    {
        return $this->role_id === 1;
    }

    public function HasRole($role)
    {
        return $this->Is_Super_Admin() || ($this->Role && $this->Role->Name === $role);
    }

    public function HasPermission($permission, $permissionType)
    {

        if ($this->Is_Super_Admin())
        {
            return true;
        }

        return $this->Role()
                ->whereHas('Permission', function ($query) use ($permission, $permissionType)
                {
                    $query->where('Name', $permission)
                          ->where($permissionType, 1);
                })
                ->exists();
    }
}

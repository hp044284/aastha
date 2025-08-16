<?php
namespace App\Models;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Role extends Model
{
    use HasSlug,HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

    protected static function booted()
    {
        static::creating(function ($role)
        {
            $role->Random_Id = self::Generate_Unique_Random_Id();
        });
    }

    private static function Generate_Unique_Random_Id()
    {
        $randomId = strtoupper('RL'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('RL'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('Name')->saveSlugsTo('Slug');
    }

    public function Permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')->withPivot('Is_Add', 'Is_Edit', 'Is_Read', 'Is_Delete', 'Status', 'Sort_Order')->withTimestamps();
    }
}

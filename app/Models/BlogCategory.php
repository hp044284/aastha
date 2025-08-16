<?php
namespace App\Models;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
class BlogCategory extends Model
{
    use HasSlug;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_categories';
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
        $randomId = strtoupper('BG'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('BG'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('Title')->saveSlugsTo('Slug');
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('blog_categories.Is_Deleted', '=', 0);
    }

    /**
     * Get the parent category.
     */
    public function Parent()
    {
        return $this->belongsTo(BlogCategory::class, 'Parent_Id');
    }

    /**
     * Get the child categories.
     */
    public function Children()
    {
        return $this->hasMany(BlogCategory::class, 'Parent_Id');
    }
}

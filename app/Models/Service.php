<?php
namespace App\Models;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    use HasSlug;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

    protected static function booted()
    {
        static::creating(function ($entity)
        {
            $entity->Random_Id = self::Generate_Unique_Random_Id();
        });
    }

    public function ServiceCategory()
    {
        return $this->belongsTo(ServiceCategory::class,'Category_Id');
    }

    private static function Generate_Unique_Random_Id()
    {
        $randomId = strtoupper('SR'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('SR'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('services.Is_Deleted', '=', 0);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('Title')->saveSlugsTo('Slug');
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquirable');
    }

    public function seo()
    {
        return $this->morphOne(SeoPage::class, 'seoable');
    }
}

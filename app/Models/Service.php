<?php
namespace App\Models;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasSlug,SoftDeletes;

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

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'enquirable');
    }

    public function seo()
    {
        return $this->morphOne(SeoPage::class, 'seoable');
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class, 'service_id');
    }
}

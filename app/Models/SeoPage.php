<?php
namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
class SeoPage extends Model
{
    use HasSlug;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seo_pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function seoable()
    {
        return $this->morphTo();
    }
}
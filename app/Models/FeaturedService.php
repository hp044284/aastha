<?php
namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturedService extends Model
{
    use SoftDeletes, HasSlug;
    protected $table = 'featured_services';
    protected $fillable = ['title', 'slug', 'sub_title', 'short_description', 'url', 'file_name', 'status'];

    public function featuredServiceTitles()
    {
        return $this->hasMany(FeaturedServiceTitle::class, 'featured_service_id', 'id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}

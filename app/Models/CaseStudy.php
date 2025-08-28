<?php
namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CaseStudy extends Model
{
    use SoftDeletes,HasSlug;

    protected $table = 'case_studies';

    protected $fillable = [
        'age',
        'image',
        'title',
        'slug',
        'gender',
        'status',
        'subtitle',
        'risk_factor',
        'description',
        'medical_history',
        'presenting_symptoms',
        'duration_of_symptoms',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}

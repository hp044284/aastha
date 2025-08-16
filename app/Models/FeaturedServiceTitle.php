<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FeaturedServiceTitle extends Model
{
    protected $table = 'featured_service_titles';
    protected $fillable = ['title', 'featured_service_id'];

    public function featuredService()
    {
        return $this->belongsTo(FeaturedService::class, 'featured_service_id', 'id');
    }
}

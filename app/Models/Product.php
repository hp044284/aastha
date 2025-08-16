<?php
namespace App\Models;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasSlug;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
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
        $randomId = strtoupper('PD'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('PD'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('products.Is_Deleted', '=', 0);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('Product_Name')->saveSlugsTo('Slug');
    }

    public function ProductFile()
    {
        return $this->hasMany(ProductFile::class, 'Product_Id');
    }

    public function ProductReview()
    {
        return $this->hasMany(Review::class, 'Product_Id')->where('Review_Type','Product');
    }

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'Product_Category_Id')->where('Parent_Id',0);
    }

    public function ProductSubCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'Product_Sub_Category_Id')->where('Parent_Id','>',0);
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

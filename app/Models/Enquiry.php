<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class Enquiry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enquiries';
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

    private static function Generate_Unique_Random_Id()
    {
        $randomId = strtoupper('EQ'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('EQ'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('enquiries.Is_Deleted', '=', 0);
    }

    public function enquirable()
    {
        return $this->morphTo();
    }
}

<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class State extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';
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
        $randomId = strtoupper('ST'.date('ym').Str::random(4));
        while (self::where('Random_Id', $randomId)->exists())
        {
            $randomId = strtoupper('ST'.date('ym').Str::random(4));
        }
        return $randomId;
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('states.Is_Deleted', '=', 0);
    }

    public function Country()
    {
        return $this->belongsTo(Country::class,'Country_Id');
    }
}

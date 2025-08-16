<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($contact) {
            $contact->random_id = self::Generate_Unique_Random_Id();
        });
    }

    private static function Generate_Unique_Random_Id()
    {
        $random_id = Str::random(10);
        $contact = self::where('random_id', $random_id)->first();
        if ($contact) {
            return self::Generate_Unique_Random_Id();
        }
        return $random_id;
    }
}

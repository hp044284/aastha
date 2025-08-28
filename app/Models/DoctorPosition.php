<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorPosition extends Model
{
    protected $table = 'doctor_positions';

    protected $fillable = [
        'doctor_id',
        'position_title',
        'start_year',
        'end_year',
        'organization',
    ];

    /**
     * Get the doctor that owns the position.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

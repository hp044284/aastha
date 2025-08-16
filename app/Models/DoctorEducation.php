<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model
{
    protected $table = 'doctor_educations';

    protected $fillable = [
        'degree',
        'end_year',
        'doctor_id',
        'start_year',
        'institution',
    ];

    /**
     * Get the doctor that owns the education record.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

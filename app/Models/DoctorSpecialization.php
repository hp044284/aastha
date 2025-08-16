<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    protected $table = 'doctor_specializations';

    protected $fillable = [
        'doctor_id',
        'specialization_id',
    ];

    /**
     * Get the doctor that owns this specialization.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * Get the specialization for this doctor.
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
}

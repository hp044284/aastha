<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'image',
        'position_id',
        'affiliation',
        'status',
        'about_us',
    ];

    /**
     * Get the education records for the doctor.
     */
    public function education()
    {
        return $this->hasMany(DoctorEducation::class, 'doctor_id');
    }

    /**
     * Get the positions for the doctor.
     */
    public function positions()
    {
        return $this->hasMany(DoctorPosition::class, 'doctor_id');
    }

    /**
     * Get the affiliations for the doctor.
     */
    public function affiliations()
    {
        return $this->hasMany(DoctorAffiliation::class, 'doctor_id');
    }

    /**
     * The specializations that belong to the doctor.
     */
    public function specializations()
    {
        return $this->belongsToMany(
            Specialization::class,
            'doctor_specializations',
            'doctor_id',
            'specialization_id'
        );
    }
}

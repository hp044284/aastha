<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorAffiliation extends Model
{
    protected $table = 'doctor_affiliations';

    protected $fillable = [
        'doctor_id',
        'organization',
        'affiliation_type',
        'role_title',
    ];

    /**
     * Get the doctor that owns the affiliation.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

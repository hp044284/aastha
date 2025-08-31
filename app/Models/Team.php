<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use SoftDeletes;

    protected $table = 'teams';
    
    protected $fillable = [
        'name',
        'file_name',
        'experience',
        'department_id',
        'positions_id',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'department_id' => 'integer',
        'positions_id' => 'integer',
    ];

    /**
     * Get the department that owns the team member
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position that owns the team member
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'positions_id');
    }

    /**
     * Scope for active team members
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the file URL
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_name) {
            return asset('storage/' . $this->file_name);
        }
        return asset('images/default-avatar.jpg');
    }
}

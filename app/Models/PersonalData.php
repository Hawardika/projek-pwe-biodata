<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;

    protected $table = 'personal_data';

    protected $fillable = [
        'name',
        'title',
        'email',
        'phone',
        'address',
        'birth_date',
        'nationality',
        'linkedin',
        'github',
        'summary',
        'skills',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->name));
        $initials = '';

        foreach ($parts as $part) {
            if (strlen($part) > 0) {
                $initials .= mb_strtoupper(mb_substr($part, 0, 1));
            }
        }

        return mb_substr($initials, 0, 2);
    }

    public function getSkillsArrayAttribute(): array
    {
        if (!$this->skills) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $this->skills)));
    }

    // ===== RELASI BARU =====
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('order');
    }

    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('order');
    }
}

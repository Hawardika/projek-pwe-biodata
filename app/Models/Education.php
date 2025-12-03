<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    // Laravel ngira plural "education" itu sama,
    // jadi kita paksa nama tabelnya.
    protected $table = 'educations';

    protected $fillable = [
        'personal_data_id',
        'institution',
        'degree',
        'location',
        'period',
        'description',
        'order',
    ];

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class);
    }
}

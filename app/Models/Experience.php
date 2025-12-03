<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    protected $fillable = [
        'personal_data_id',
        'title',
        'company',
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

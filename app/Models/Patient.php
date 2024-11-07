<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Define the table if it’s different from the default naming convention
    protected $table = 'patients';

    // Fields that are mass assignable
    protected $fillable = [
        'name',        // Patient name
        'address',     // Patient address
        'phone',       // Contact phone
        'hospital_id', // Foreign key for the related hospital
    ];

    /**
     * Define an inverse relationship with the Hospital model.
     * A patient belongs to a hospital.
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    // Define the table if it’s different from the default naming convention
    protected $table = 'hospitals';

    // Fields that are mass assignable
    protected $fillable = [
        'name',      // Hospital name
        'address',   // Hospital address
        'email',     // Contact email
        'phone',     // Contact phone
    ];

    /**
     * Define a relationship with the Patient model.
     * A hospital can have many patients.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}

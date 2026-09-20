<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_code',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'photo',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function totalDonated(): float
    {
        return $this->donations()->sum('amount');
    }

    
    // Public URL for the donor's photo, or null if none uploaded.
    
    public function photoUrl(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    
    // Generate the next donor code
    
    public static function generateDonorCode(): string
    {
        $last = static::orderByDesc('id')->first();
        $nextNumber = $last ? $last->id + 1 : 1;

        return 'DNR-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
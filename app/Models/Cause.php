<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'target_amount',
        'status',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
        ];
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function totalCollected(): float
    {
        return $this->donations()->sum('amount');
    }

    
    // Percentage of target amount collected so far (capped at 100).
    
    public function progressPercentage(): float
    {
        if ($this->target_amount <= 0) {
            return 0;
        }

        $percentage = ($this->totalCollected() / $this->target_amount) * 100;

        return round(min($percentage, 100), 1);
    }

    
    // Public URL for the cause's banner image, or null if none uploaded.
    
    public function imageUrl(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
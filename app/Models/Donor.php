<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function totalDonated(): float
    {
        return $this->donations()->sum('amount');
    }

    /**
     * Generate the next donor code, e.g. DNR-0001
     */
    public static function generateDonorCode(): string
    {
        $last = static::orderByDesc('id')->first();
        $nextNumber = $last ? $last->id + 1 : 1;

        return 'DNR-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}

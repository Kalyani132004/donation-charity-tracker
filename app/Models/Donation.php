<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'donor_id',
        'cause_id',
        'amount',
        'donation_mode',
        'donation_date',
        'financial_category',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'donation_date' => 'date',
        ];
    }

    public const DONATION_MODES = [
        'Cash',
        'UPI',
        'Bank Transfer',
        'Cheque',
        'Card',
    ];

    public const FINANCIAL_CATEGORIES = [
        'Education',
        'Healthcare',
        'Food & Basic Needs',
        'Disaster Relief',
        'Child Welfare',
        'Senior Citizen Support',
        'General Charity',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Generate the next receipt number
     * Numbering resets per calendar year.
     */
    public static function generateReceiptNumber(): string
    {
        $year = now()->year;

        $lastThisYear = static::where('receipt_number', 'like', "REC-{$year}-%")
            ->orderByDesc('id')
            ->first();

        if ($lastThisYear) {
            $lastSequence = (int) substr($lastThisYear->receipt_number, -4);
            $nextSequence = $lastSequence + 1;
        } else {
            $nextSequence = 1;
        }

        return "REC-{$year}-" . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdventureTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'difficulty',
        'price',
        'duration',
        'image_url',
    ];

    // Difficulty levels as constants
    const DIFFICULTY_EASY = 'easy';
    const DIFFICULTY_MODERATE = 'moderate';
    const DIFFICULTY_CHALLENGING = 'challenging';
    const DIFFICULTY_EXTREME = 'extreme';

    // Get available difficulty levels
    public static function getDifficultyLevels()
    {
        return [
            self::DIFFICULTY_EASY => 'Easy',
            self::DIFFICULTY_MODERATE => 'Moderate',
            self::DIFFICULTY_CHALLENGING => 'Challenging',
            self::DIFFICULTY_EXTREME => 'Extreme',
        ];
    }

    // Reviews relationship
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Bookings relationship
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
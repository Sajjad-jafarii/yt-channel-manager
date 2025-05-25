<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'video_title',
        'publish_time',
        'description', // اگر نیاز داری
        // فیلدهای دیگر در صورت نیاز
    ];

    /**
     * هر برنامه زمان‌بندی متعلق به یک کانال است.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}

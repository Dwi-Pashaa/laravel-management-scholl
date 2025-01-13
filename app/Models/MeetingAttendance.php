<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    use HasFactory;
    protected $table = 'meeting_attendances';
    protected $fillable = ['mettings_id', 'users_id', 'status'];

    public function metting()
    {
        return $this->belongsTo(Metting::class, 'mettings_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

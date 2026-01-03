<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'chapter_id',
        'invited_by_user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'business_name',
        'industry',
        'status',
        'first_visit_date',
        'do_not_contact',
    ];

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }

    public function invitedByUser() {
        return $this->belongsTo(User::class, 'invited_by_user_id');
    }
}

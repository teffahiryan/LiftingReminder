<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function exercises () {
        return $this->belongsToMany(Exercise::class)->withPivot('repetition', 'set', 'weight');
    }

    public function imageUrl (): string {
        return Storage::url($this->image);
    }
}

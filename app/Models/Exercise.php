<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'repetition',
        'set',
        'image',
        'user_id',
        'isShared',
        'sharedCreator'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function imageUrl (): string {
        return Storage::url($this->image);
    }
}

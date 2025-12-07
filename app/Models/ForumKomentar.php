<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumKomentar extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi rekursif (reply)
    public function balas()
    {
        return $this->hasMany(ForumKomentar::class, 'parent_id')
            ->orderBy('created_at', 'asc');
    }

    // Untuk menampilkan parent comment (jika ini reply)
    public function parent()
    {
        return $this->belongsTo(ForumKomentar::class, 'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'owner',
        'image',
    ];

    /**
     * Get the owner that owns the Planes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    /**
     * Get all of the rents for the Planes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rents(): HasMany
    {
        return $this->hasMany(Rents::class, 'peminjam', 'id');
    }
}

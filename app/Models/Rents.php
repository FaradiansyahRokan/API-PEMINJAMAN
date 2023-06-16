<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rents extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status'
    ];

    /**
     * Get the penyewa that owns the Rents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penyewa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the pesawat that owns the Rents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesawat(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }
}

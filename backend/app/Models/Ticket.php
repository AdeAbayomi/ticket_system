<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'content', 'user_id', 'status'];

    /**
       * Get the user that owns the Ticket
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}

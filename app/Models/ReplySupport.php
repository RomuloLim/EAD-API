<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplySupport extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $table = 'reply_support';
    protected $fillable = [
        'description',
        'support_id',
        'user_id'
    ];

    protected $touches = ['support'];

    public function support(): BelongsTo
    {
        return $this->belongsTo(Support::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

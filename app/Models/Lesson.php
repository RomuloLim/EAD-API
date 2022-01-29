<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $table = 'lessons';

    protected $fillable = [
        'name',
        'escription',
        'video'
    ];

    public function supports(): HasMany
    {
        return  $this->hasMany(Support::class);
    }
}

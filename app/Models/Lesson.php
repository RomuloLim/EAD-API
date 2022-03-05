<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $table = 'lessons';

    protected $fillable = [
        'module_id',
        'name',
        'url',
        'video',
    ];

    public function supports(): HasMany
    {
        return $this->hasMany(Support::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class)
            ->where(function ($q) {
                if (Auth::check())
                    return $q->where('user_id', Auth::user()->id);
            });
    }
}

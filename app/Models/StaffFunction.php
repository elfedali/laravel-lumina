<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffFunction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'function_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'model'
    ];
    public function data(): HasMany
    {
        return $this->hasMany(Data::class);
    }

}

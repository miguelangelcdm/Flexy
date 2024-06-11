<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'ph', 'temperatura', 'conductividad', 'oxigeno_disuelto', 'device_id','timestamp'
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}

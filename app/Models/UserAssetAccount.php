<?php

namespace App\Models;

use App\Enums\UserAssetAccountStatus;
use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAssetAccount extends Pivot
{
    use HasUUID;
    use HasFactory;

    protected $casts = [
        'status' => UserAssetAccountStatus::class,
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkRequestAttachment extends Model
{
    public function workRequest(): BelongsTo
    {
        return $this->belongsTo(WorkRequest::class);
    }
}

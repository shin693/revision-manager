<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkRequest extends Model
{
    public const STATUS_LABELS = [
        'unhandled' => '未対応',
        'reviewing' => '依頼内容確認中',
        'assigned' => '担当割当て済',
        'in_progress' => '担当対応中',
        'testing' => 'テスト確認依頼中',
        'before_release' => '本番反映前',
        'completed' => '完了（本番反映済）',
        'on_hold' => '保留',
        'other' => 'その他',
    ];


    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? '不明';
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }
    
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(WorkRequestAttachment::class);
    }
}

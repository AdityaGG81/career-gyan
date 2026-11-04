<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiChatLog extends Model
{
    use HasFactory;

    protected $table = 'ai_chat_logs';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'session_id',
        'question',
        'reply',
        'sources',
        'model_used',
        'status',
        'error_message',
        'response_time_ms',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'sources' => 'array',
        'response_time_ms' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship to the user who asked the question (if authenticated).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter logs by search keyword, date, and status.
     */
    public function scopeFilter($query, array $filters)
    {
        // Search filter (keyword)
        if (!empty($filters['q'])) {
            $search = trim($filters['q']);
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('reply', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('user_email', 'like', "%{$search}%")
                  ->orWhere('session_id', 'like', "%{$search}%");
            });
        }

        // Status filter
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        // Specific user filter
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Date range filter
        if (!empty($filters['date'])) {
            switch ($filters['date']) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', today()->subDay());
                    break;
                case 'last_7_days':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case 'last_30_days':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case 'this_month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
            }
        }

        return $query;
    }
}


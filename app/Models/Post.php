<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'skill_id', 'excerpt', 'slug',
    ];

    public function scopeArchive($query)
    {

        return $query->select(DB::raw('year(created_at) as year,count(id) as total'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public function scopeWithArchive($query, $year)
    {
        if ($year) {
            return $query->whereYear('created_at', $year);
        }

        return $query;
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'reply':
                $query = $this->recentReplied();
                break;

            default:
                $query = $this->recentReleased();
                break;
        }

        return $query->with(['user', 'skill']);
    }

    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecentReleased($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'post_id', 'user_id')
            ->orderBy('follows.created_at', 'desc')
            ->withPivot('created_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->orderBy('comments.updated_at', 'desc');
    }

    /**
     * 添加博客文章的访问记录
     * @param  Request $request [description]
     * @return [type] [description]
     */
    public function visit(Request $request)
    {
        $visit = [];
        if (Auth::check()) {
            $visit['user_id'] = Auth::id();
        }

        $visit['ip'] = $request->getClientIp();

        return $this->visits()->create($visit);
    }

    /**
     * 获取访问数
     * @return [type] [description]
     */
    public function visitCounts()
    {
        return $this->hasMany(Visit::class)->count();
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}

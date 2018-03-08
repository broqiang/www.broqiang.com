<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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

    public function scopeWithList($query, Request $request)
    {
        $query = $this->withOrder($request->order);

        return $query->with(['User', 'Skill']);
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
        return $query;
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
}

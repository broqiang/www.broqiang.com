<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable {
        notify as laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'github', 'weibo', 'introduction', 'homepage', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * 用户关注的文章
     * @return [type] [description]
     */
    public function follows()
    {
        return $this->belongsToMany(Post::class, 'follows', 'user_id', 'post_id')
            ->orderBy('posts.created_at', 'desc')
            ->limit(5)
            ->withPivot('created_at');
    }

    public function followsAll()
    {
        return $this->belongsToMany(Post::class, 'follows', 'user_id', 'post_id')
            ->orderBy('posts.created_at', 'desc');
    }

    public function commentsPreview()
    {
        return $this->hasMany(Comment::class)
            ->limit(5)
            ->orderBy('comments.updated_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('comments.updated_at', 'desc');
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function isSuperAdmin ()
    {
        return $this->is_admin;
    }
}

<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
}

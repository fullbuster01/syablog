<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;


class Post extends Model implements Viewable
{

    use InteractsWithViews;
    use SoftDeletes;

    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function tags()
    {
        return $this->belongsToMany(Tag::class); // ini relasi many to many untuk tabel post_tag
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasMany(Thumbnail::class, 'post_id', 'id');
    }
}

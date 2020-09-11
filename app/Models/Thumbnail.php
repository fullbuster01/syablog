<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thumbnail extends Model
{
    use SoftDeletes;
    protected $fillable = ['post_id', 'image', 's', 'm', 'l', 'xl', 'xxl'];
    // protected $guarded = [];

    public const UPLOAD_DIR = 'uploads';
    public const s = '130x90';
    public const m = '350x250';
    public const l = '375x281';
    public const xl = '760x570';
    public const xxl = '1140x434';

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }


}

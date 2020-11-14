<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Post extends Model
{
    use SoftDeletes;

	protected $table = 'posts';

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public static function getPosts(){
        $records = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id', 'posts.title', 'posts.body', 'users.name')
            ->get()
            ->toArray();
        return $records;
    }

    /*
    public function getRouteKeyName(){
    	return 'title';
    }
    */
}

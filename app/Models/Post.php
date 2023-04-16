<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public $directory = "/images/";
    use HasFactory;
    use SoftDeletes;
    //to change default name
    //protected $table = 'tablename';
    //to change primary key
    //protected $primaryKey = 'pkey';
    //will let be fillable
    protected $fillable = [
        'title',
        'content',
        'path'
    ];
    //for soft delete
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
    public function tags(){
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
    //querry scope
    public static function scopeLatest($query){
        return $query->orderBy('title', 'asc')->get();
    }
    //query scopes
    public function getPathAttribute($value){
        return $this->directory.$value;
    }
}

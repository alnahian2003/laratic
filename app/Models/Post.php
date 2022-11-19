<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;


    // The event map for the model
    // protected $dispatchesEvents = [
    //     'created' => PostCreated::class,
    // ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Setting a custom database connection
     *
     * @var string
     */
    protected $connection = 'sqlite';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'views' => 0 // new post views will set to 0
    ];

    /**
     * Defining Fillable Properties For Massive Assignment
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Get the user's latest image.
     */
    public function latestImage()
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    /**
     * Get the user's oldest image.
     */
    public function oldestImage()
    {
        return $this->morphOne(Image::class, 'imageable')->oldestOfMany();
    }

    /**
     * Get all tags of the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->as('taggable');
    }


    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function prunable()
    {
        return static::where("created_at", ">", now()->subMinutes(30));
    }


    protected static function booted()
    {
        self::retrieved(function ($post) {
            info("Post {$post->id} was viewed by someone.");
        });
    }
}

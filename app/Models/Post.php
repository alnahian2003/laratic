<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, MassPrunable;

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
        'cover'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
}

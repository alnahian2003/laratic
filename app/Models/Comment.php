<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * All of the relationships to be touched.
     * 
     * When Comment model is updated, automatically "touch" the updated_at
     * timestamp of the owning Post so that it is set to the current date and time.
     * 
     * @var array
     */
    // protected $touches = ['post'];

    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}

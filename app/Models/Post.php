<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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
}

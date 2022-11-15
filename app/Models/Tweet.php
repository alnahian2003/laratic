<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $casts = [
        "active" => "boolean",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // static::addGlobalScope(new ActiveScope);

        // Anonymous Global Scope
        /* static::addGlobalScope("inactive", fn (Builder $builder) => $builder->where("active", false)); */
    }


    /**
     * Local Scope for Querying Active Records
     * 
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $query->whereActive(true);
    }

    public function scopeSearch($query)
    {
        $query->when(request()->has("q"), fn ($query) => $query->where("content", "like", "%" . request("q") . "%"));
    }
}

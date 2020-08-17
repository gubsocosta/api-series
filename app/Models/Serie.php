<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Serie
 *
 * @package App\Models
 */
class Serie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'series';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Quantity items per page
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [ 'links' ];

    /**
     * Get the serie episodes
     */
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    /**
     * Get the utils links for the serie.
     *
     * @return array
     */
    public function getLinksAttribute(): array
    {
        return [
            'self' => url() . '//series/' . $this->id,
            'episodes' => url() . '//series/' . $this->id . '/episodes',
        ];
    }
}

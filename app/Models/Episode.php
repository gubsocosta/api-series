<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Episode
 *
 * @package App\Models
 */
class Episode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'episodes';

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
    protected $fillable = ['season', 'number', 'serie_id', 'viewed'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [ 'links' ];

    /**
     * Get the serie that contains the episode
     */
    public function Serie()
    {
        return $this->belongsTo(Serie::class);
    }

    /**
     * Get viewed value in boolean format
     *
     * @param string $value
     * @return bool
     */
    public function getViewedAttribute(string $value): bool
    {
        return $value;
    }

    /**
     * Get utils links about the episode
     *
     * @return array
     */
    public function getLinksAttribute(): array
    {
        return [
            'self' => url() . '//episodes/' . $this->id,
            'serie' => url() . '//series/' . $this->serie_id
        ];
    }
}

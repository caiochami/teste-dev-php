<?php

namespace App\Models;

use App\Traits\HasSerializedDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Car.
 *
 * @package namespace App\Models;
 */

class Car extends Model
{
    use HasFactory, HasSerializedDates;

    protected $hidden = [];

    protected $appends = ['brand_name'];

    protected $casts = [
        'model' => 'string',
        'year' => 'integer'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'brand_id',
        'year'
    ];

    /**
     * Return the brand the owns the model
     * 
     * @return BelongsTo
     */

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getBrandNameAttribute()
    {
        return $this->brand->name;
    }
}

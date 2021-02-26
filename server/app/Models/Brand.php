<?php

namespace App\Models;

use App\Traits\HasSerializedDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Brand.
 *
 * @package namespace App\Models;
 */
class Brand extends Model implements Transformable
{
  use TransformableTrait, HasFactory, HasSerializedDates;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Return all associated cars 
   * 
   * @return HasMany
   */

  public function cars(): HasMany
  {
    return $this->hasMany(Car::class);
  }
}

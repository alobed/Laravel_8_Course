<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /* $guarded holds the properties that will be ignored in term of update the recoed in database
     
      $fillable if do the reverse of $guarded. You have to fill it wil allowed properties

      note: you can use only one of them simultanously
     */

    protected $guarded = ['id'];
    // protected $fillable = ['title','excerpt', 'body'];

    // Eloquent Relationship
    public function category()
    {
      // hasOne, hasMany, belongsto, belongsToMany
      return $this->belongsTo(category::class);
    }
}

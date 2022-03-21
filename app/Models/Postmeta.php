<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model
{
    use HasFactory;
    protected $table = 'postmetas';
	public $timestamps = true;
      protected $fillable = ['id','cat_id','post_id'];

    public function metareletion()
    {
    	  return $this->belongsTo(Category::class, 'id');
    }
}

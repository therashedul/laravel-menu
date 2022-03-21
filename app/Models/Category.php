<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	protected $table = 'categories';
	public $timestamps = true;
    protected $fillable = ['title','name', 'slug', 'parent_id','link','status'];

    public function subcategory()
	    {
	        return $this->hasMany(Category::class, 'parent_id', 'id');
	    }

	public function parent()
	    {
	        return $this->belongsTo(Category::class, 'parent_id');
	    }
}

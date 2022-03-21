<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
		protected $table = 'pages';
	public $timestamps = true;
    protected $fillable = [
		'title',
		'name', 
		'slug', 
		'link',
		'parent_id',
		'content',
		'image',
		'status',
		'publish_at',
		'user_id',
		'template',
	];
	
    public function subpage()
	    {
	        return $this->hasMany(Page::class, 'parent_id', 'id');
	    }

	public function parent()
	    {
	        return $this->belongsTo(Page::class, 'parent_id');
	    }
	public function user()
	    {
	        return $this->belongsTo(User::class, 'id');
	    }
}

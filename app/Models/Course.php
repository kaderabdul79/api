<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','category_id','description','status','price','slug'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // protected $hidden = ['created_at', 'updated_at'];

}

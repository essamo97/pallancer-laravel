<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     public static function rules()
     {
        return [

       ];
     }
   // $request->validate(Category::riles());
   public function products()
   {
       return $this->hasMany(Product::class,'category_id','id');
   }

   public function children(){
       return $this->hasMany(Category::class,'parent_id','id');
   }

   public function parent(){
       return $this->belongsTo(Category::class,'parent_id','id');
   }
}

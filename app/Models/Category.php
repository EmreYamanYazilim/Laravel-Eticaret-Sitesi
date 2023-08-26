<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use Sluggable,HasFactory;
    protected $fillable = ['image','thumbnail','name','slug','content','category_up','status'];


    public function items()
    {
        return $this->hasMany(Product::class,
            'category_id',
            'id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class,
            'category_up',
            'id');

    }


    public function getTotalProductCount()
    {
        $total = $this->items()->count();

        foreach ($this->subcategory as $childCategory) {

            $total += $childCategory->items()->count();  // alt kategorideki ürünlerin sayısını toplayıp verme
        }
        return $total;
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}

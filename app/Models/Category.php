<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'categories';

    public static function tree() {
        $allCategories = Category::get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::formatTree($rootCategories, $allCategories);
        return $rootCategories;
    }

    private static function formatTree($categories, $allCategories) {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty()){
                self::formatTree($category->children, $allCategories);
            }
        }
    }

    public function getParentAttribute() {
        return Category::whereId($this->parent_id)->first();
    }
}

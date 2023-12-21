<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function getParentAttribute() {
        return Page::whereId($this->parent_id)->first();
    }

    public function getFormatSlugAttribute() {
        $segments = explode('/', $this->slug);
        $lastSegment = array_pop($segments);
        return $lastSegment;
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}

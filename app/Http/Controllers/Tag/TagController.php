<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug=null) {
        if ($slug === null){

            $tags = Tag::all();
            return view('tag', compact('tags'));
        }
        $tag = Tag::where('slug', $slug)->firstOrFail();
        if (!$tag) return abort(404);
        return view('tag', compact('tag'));
    }
}

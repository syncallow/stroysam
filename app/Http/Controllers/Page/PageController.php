<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug=null) {
        //$file = file_get_contents('../resources/views/pages/index.blade.php');

        if ($slug === null) {
            $page = Page::where('slug', '/')->orWhere('alias', '/')->firstOrFail();

            if (!$page) return abort(404);
            return view('pages.'.$page->filename, compact('page'));
        }
        $page = Page::where('slug', $slug)->orWhere('alias', $slug)->firstOrFail();
        if (!$page) return abort(404);
        return view('pages.'.$page->filename, compact('page'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StoreRequest;
use App\Http\Requests\Admin\Page\UpdateRequest;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index() {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create() {
        $pages = Page::where('slug', '!=', '/')->get();
        return view('admin.pages.create',compact('pages'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $tags = explode(', ', $data['meta_keywords']);

        foreach ($tags as $tag) {
            $existTag = Tag::where('title', $tag)->first();

            if (!$existTag) {
                Tag::create([
                    'title' => $tag,
                    'slug' => Str::slug($tag, '-')
                ]);
            }
        }

        $existTags = Tag::whereIn('title', $tags)->pluck('id')->toArray();

        if (!empty($data['parent_id'])) {
            $pageUrl = Page::whereId($data['parent_id'])->first('slug');
            if (!$pageUrl) return redirect()->back()->with('error', 'Не найдена родительская страница');
            $data['slug'] = $pageUrl->slug. '/'. $data['slug'];
        }
        if (file_exists('../resources/views/pages/'.$data['filename'].'.blade.php')) return redirect()->back()->with('error', 'Такой файл уже есть');
        $newFile = file_put_contents('../resources/views/pages/'.$data['filename'].'.blade.php', $data['fileContent']);
        if (!$newFile) return redirect()->back()->with('error', 'Ошибка при создании файла.');
        unset($data['fileContent']);
        $newPage = Page::create($data);
        if (!$newPage) return redirect()->back()->with('error', 'Ошибка при создании страницы');
        $newPage->tags()->attach($existTags);
        return redirect()->route('admin.pages.index')->with('success', 'Страница успешно создана.');
    }

    public function edit(Page $page) {
        $fileContent = file_get_contents('../resources/views/pages/'.$page->filename.'.blade.php');
        $pages = Page::where('id', '!=', $page->id)->where('slug', '!=', '/')->get();
        return view('admin.pages.edit', compact('page','pages', 'fileContent'));
    }

    public function update(UpdateRequest $request, Page $page) {
        $data = $request->validated();

        $tags = explode(', ', $data['meta_keywords']);

        foreach ($tags as $tag) {
            $existTag = Tag::where('title', $tag)->first();

            if (!$existTag) {
                Tag::create([
                    'title' => $tag,
                    'slug' => Str::slug($tag, '-')
                ]);
            }
        }

        $existTags = Tag::whereIn('title', $tags)->pluck('id')->toArray();

        if (!empty($data['parent_id'])) {
            $pageUrl = Page::whereId($data['parent_id'])->first('slug');
            if (!$pageUrl) return redirect()->back()->with('error', 'Не найдена родительская страница');
            $data['slug'] = $pageUrl->slug. '/'. $data['slug'];
        }
        if ($data['filename'] != $page->filename) {
            if (file_exists('../resources/views/pages/'.$page->filename.'.blade.php')) unlink('../resources/views/pages/'.$page->filename.'.blade.php');
            $newFile = file_put_contents('../resources/views/pages/'.$data['filename'].'.blade.php', $data['fileContent']);
            if (!$newFile) return redirect()->back()->with('error', 'Ошибка при создании файла');
        } else {
            $updatedFile = file_put_contents('../resources/views/pages/'.$data['filename'].'.blade.php', $data['fileContent']);
            if (!$updatedFile) return redirect()->back()->with('error', 'Ошибка при обновлении файла');
        }
        unset($data['fileContent']);

        $updatedPage = $page->update($data);
        if (!$updatedPage) return redirect()->back()->with('error', 'Ошибка при создании страницы');
        $page->tags()->sync($existTags);
        return redirect()->back()->with('success', 'Страница успешно обновлена');
    }

    public function delete(Page $page) {
        Page::where('parent_id', '=', $page->id)->update(['parent_id' => null]);
        $page->tags()->detach();
        $page->delete();
        unlink('../resources/views/pages/'.$page->filename.'.blade.php');
        return redirect()->back()->with('success', 'Страница успешно удалена');
    }
}

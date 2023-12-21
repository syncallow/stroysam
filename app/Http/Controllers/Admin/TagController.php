<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Page;
use App\Models\Tag;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function create() {
        $pages = Page::all();
        return view('admin.tags.create', compact('pages'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $pageIds = !empty($data['page_ids']) ? $data['page_ids'] : false;
        unset($data['page_ids']);
        $newTag = Tag::create($data);
        if (!$newTag) return redirect()->back()->with('error', 'Ошибка при создании тега.');
        if ($pageIds) {
            $newTag->pages()->attach($pageIds);
        }
        return redirect()->route('admin.tags.index')->with('success', 'Тег успешно создан');
    }

    public function edit(Tag $tag) {
        $pages = Page::all();
        return view('admin.tags.edit', compact ('pages','tag'));
    }

    public function update(UpdateRequest $request, Tag $tag) {
        $data = $request->validated();
        $pageIds = !empty($data['page_ids']) ? $data['page_ids'] : false;
        unset($data['page_ids']);
        $res = $tag->update($data);
        if (!$res) return redirect()->back()->with('error', 'Ошибка при редактировании тега.');
        if ($pageIds) {
            $tag->pages()->sync($pageIds);
        }
        return redirect()->back()->with('success', 'Тег отредатирован успешно');
    }

    public function delete(Tag $tag) {
        $res = $tag->delete();
        if (!$res) return redirect()->back()->with('error', 'Ошибка при удалении тега');
        return redirect()->route('admin.tags.index')->with('success', 'Тег успешно удален');
    }
}

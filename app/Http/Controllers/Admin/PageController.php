<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StoreRequest;
use App\Http\Requests\Admin\Page\UpdateRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create() {
        return view('admin.pages.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        if (file_exists('../resources/views/pages/'.$data['filename'].'.blade.php')) return redirect()->back()->with('error', 'Такой файл уже есть');
        $newFile = file_put_contents('../resources/views/pages/'.$data['filename'].'.blade.php', $data['fileContent']);
        if (!$newFile) return redirect()->back()->with('error', 'Ошибка при создании файла.');
        unset($data['fileContent']);
        $newPage = Page::create($data);
        if (!$newPage) return redirect()->back()->with('error', 'Ошибка при создании страницы');
        return redirect()->route('admin.pages.index')->with('success', 'Страница успешно создана.');
    }

    public function edit(Page $page) {
        $fileContent = file_get_contents('../resources/views/pages/'.$page->filename.'.blade.php');
        return view('admin.pages.edit', compact('page', 'fileContent'));
    }

    public function update(UpdateRequest $request, Page $page) {
        $data = $request->validated();
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
        return redirect()->back()->with('success', 'Страница успешно обновлена');
    }
}

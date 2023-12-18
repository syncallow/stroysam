<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Layout\StoreRequest;
use App\Http\Requests\Admin\Layout\UpdateRequest;
use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index() {
        $layouts = Layout::all();
        return view('admin.layouts.index', compact('layouts'));
    }

    public function create() {
        return view('admin.layouts.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        if (file_exists('../resources/views/layouts/'.$data['filename'].'.blade.php')) return redirect()->back()->with('error', 'Такой файл уже есть');
        $newFile = file_put_contents('../resources/views/layouts/'.$data['filename'].'.blade.php', $data['fileContent']);
        if (!$newFile) return redirect()->back()->with('error', 'Ошибка при создании файла.');
        unset($data['fileContent']);
        $newLayout = Layout::create($data);
        if (!$newLayout) return redirect()->back()->with('error', 'Ошибка при создании шаблона');
        return redirect()->route('admin.layouts.index')->with('success', 'Шаблон успешно создан.');
    }

    public function edit(Layout $layout) {
        $fileContent = file_get_contents('../resources/views/layouts/'.$layout->filename.'.blade.php');
        return view('admin.layouts.edit', compact('layout', 'fileContent'));
    }

    public function update(UpdateRequest $request, Layout $layout) {
        $data = $request->validated();
        if ($data['filename'] != $layout->filename) {
            if (file_exists('../resources/views/layouts/'.$layout->filename.'.blade.php')) unlink('../resources/views/layouts/'.$layout->filename.'.blade.php');
            $newFile = file_put_contents('../resources/views/layouts/'.$data['filename'].'.blade.php', $data['fileContent']);
            if (!$newFile) return redirect()->back()->with('error', 'Ошибка при создании файла');
        } else {
            $updatedFile = file_put_contents('../resources/views/layouts/'.$data['filename'].'.blade.php', $data['fileContent']);
            if (!$updatedFile) return redirect()->back()->with('error', 'Ошибка при обновлении файла');
        }
        unset($data['fileContent']);

        $updatedLayout = $layout->update($data);
        if (!$updatedLayout) return redirect()->back()->with('error', 'Ошибка при создании шаблона');
        return redirect()->back()->with('success', 'Шаблон успешно обновлен');
    }
}

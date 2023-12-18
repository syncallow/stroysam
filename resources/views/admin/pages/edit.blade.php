@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Редактировать страницу</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.pages.update', $page->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="filename">Название файла(*)</label>
                            <input type="text" name="filename" class="form-control" id="filename" placeholder="filename" value="{{ $page->filename }}" required>
                            @error('filename')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug(*)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="parent_slug">{{ $page->Parent ? $page->Parent->slug.'/' : '/' }}</span>
                                </div>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" value="{{ $page->Parent ? str_replace($page->Parent->slug. '/', '', $page->slug) : $page->slug }}"  required>
                                @error('slug')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Алиас(*)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">/</span>
                                </div>
                                <input type="text" name="alias" class="form-control" id="alias" placeholder="alias" value="{{ $page->alias }}" required>
                                @error('alias')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родительская страница</label>

                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="">--Выбрать--</option>
                                @foreach($pages as $allPage)
                                    <option value="{{ $allPage->id }}" {{ $allPage->id === $page->parent_id ? 'selected' : '' }}>{{ $allPage->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title(*)</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{ $page->title }}" required>
                            @error('title')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Контент(*)</label>
                            <textarea class="w-100" id="content" name="content" required>{{ $page->content }}</textarea>
                            @error('content')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Код файла</label>
                            <textarea name="fileContent" id="codeEditor">{{ $fileContent }}</textarea>
                            @error('fileContent')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" value="{{ $page->id }}" name="id">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

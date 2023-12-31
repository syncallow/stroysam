@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создать шаблон</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.pages.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="filename">Название файла(*)</label>
                            <input type="text" name="filename" class="form-control" id="filename" placeholder="filename" required>
                            @error('filename')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug(*)</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" required>
                            @error('slug')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Название шаблона(*)</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="title" required>
                            @error('title')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Контент(*)</label>
                            <textarea class="w-100" id="content" name="content" required></textarea>
                            @error('content')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Код файла</label>
                            <textarea name="fileContent" id="codeEditor"></textarea>
                            @error('fileContent')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Редактировать шаблон</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.layouts.update', $layout->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="filename">Название файла(*)</label>
                            <input type="text" name="filename" class="form-control" id="filename" placeholder="filename" value="{{ $layout->filename }}" required>
                            @error('filename')
                            <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Название шаблона(*)</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{ $layout->name }}" required>
                            @error('name')
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
                        <input type="hidden" value="{{ $layout->id }}" name="id">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

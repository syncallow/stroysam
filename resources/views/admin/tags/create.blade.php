@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создать Тег</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.tags.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название(*)</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Название" required>
                            @error('title')
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
                            <label for="page_ids">Привяжите страницы</label>
                            <select multiple class="form-control select2" name="page_ids[]" id="page_ids">
                                @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
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

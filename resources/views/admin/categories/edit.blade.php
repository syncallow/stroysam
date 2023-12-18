@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Редактировать категорию</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Название(*)</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Название" value="{{ $category->title }}" required>
                                @error('filename')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug(*)</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" value="{{ $category->slug }}" required>
                                @error('slug')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Родительская категория</label>
                                <select class="form-control select2" name="parent_id" id="parent_id">
                                    <option value="">-- Выбрать --</option>
                                    @foreach($categories as $allCategory)
                                        <option value="{{ $allCategory->id }}" {{ $category->parent_id === $allCategory->id ? 'selected' : '' }}>{{ $allCategory->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

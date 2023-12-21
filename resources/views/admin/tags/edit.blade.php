@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Редактировать Тег</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.tags.update', $tag->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Название(*)</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Название" value="{{ $tag->title }}" required>
                                @error('title')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug(*)</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="slug" value="{{ $tag->slug }}" required>
                                @error('slug')
                                <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_ids">Привязанные страницы</label>
                                <select multiple class="form-control select2" name="page_ids[]" id="page_ids">
                                    <option value="">-- Выбрать --</option>
                                    @foreach($pages as $page)
                                        <option {{ is_array( $tag->pages->pluck('id')->toArray()) && in_array($page->id, $tag->pages->pluck('id')->toArray()) ? 'selected' : '' }}  value="{{ $page->id }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="id" value="{{ $tag->id }}">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

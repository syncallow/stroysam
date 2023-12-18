@extends('admin.layout.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Все страницы</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Создать страницу</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название файлы</th>
                            <th>Slug</th>
                            <th>Алиас</th>
                            <th>Title</th>
                            <th>Родительская страница</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{$page->filename}}</td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ $page->alias }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->Parent ? $page->Parent->title : 'Нету' }}</td>
                            <td>
                                <a target="_blank" href="{{ route('page.index', $page->slug) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-success">Edit</a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delPage_{{ $page->id }}').submit()" class="btn btn-danger">Delete</a>
                                <form action="{{ route('admin.pages.delete', $page->id) }}" id="delPage_{{ $page->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

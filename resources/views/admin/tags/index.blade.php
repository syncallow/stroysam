@extends('admin.layout.main')

@section('content')
    <div class="container py-5">
        <div class="row mb-5 bg-dark p-3 rounded">
            <div class="col-2">
                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Создать Тег</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delTag_{{ $tag->id }}').submit()" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <form class="d-none" action="{{ route('admin.tags.delete', $tag->id) }}" method="post" id="delTag_{{ $tag->id }}">@csrf @method('DELETE')</form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $tags->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
@endsection

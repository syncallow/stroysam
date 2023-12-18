@extends('admin.layout.main')

@section('content')
    <div class="container py-5">
        <div class="row mb-5 bg-dark p-3 rounded">
            <div class="col-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Создать категорию</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ol class="tree-structure">
                    @foreach($categories as $category)
                    <li>
                        <a href=""><span class="num"><i class="fas fa-eye"></i></span></a>
                        <a href="#" class="mr-1">{{ $category->title }} </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-dark"><i class="fas fa-edit"></i></a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('delCategory_{{ $category->id }}').submit()" class="text-dark"><i class="fas fa-trash"></i></a>
                        <form class="d-none" action="{{ route('admin.categories.delete', $category->id) }}" method="post" id="delCategory_{{ $category->id }}">@csrf @method('DELETE')</form>
                        @if($category->children->isNotEmpty())
                            @include('admin.categories.show', ['categories' => $category->children])
                        @endif
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection

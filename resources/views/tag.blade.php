@extends('layouts.default')

@section('content')
    <div class="h-100 pt-5 mt-5"></div>
    <div class="container mt-5">
        <div class="p-5">
            <div class="row gap-2">
                @foreach($tag->pages as $page)
                <div class="col-4">
                    <a href="{{ route('page.index', $page->slug) }}">{{ $page->title }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

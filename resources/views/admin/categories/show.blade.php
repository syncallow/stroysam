<ol>
    @foreach($categories as $category)
    <li>
        <a href=""><span class="num"><i class="fas fa-eye"></i></span></a>
        <a href="#">{{ $category->title }}</a>
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-dark"><i class="fas fa-edit"></i></a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('delCategory_{{ $category->id }}').submit()" class="text-dark"><i class="fas fa-trash"></i></a>
        <form class="d-none" action="{{ route('admin.categories.delete', $category->id) }}" method="post" id="delCategory_{{ $category->id }}">@csrf @method('DELETE')</form>
        @if($category->children->isNotEmpty())
            @include('admin.categories.show', ['categories' => $category->children])
        @endif
    </li>
    @endforeach
</ol>

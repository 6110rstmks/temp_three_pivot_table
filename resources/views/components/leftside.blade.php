
{{-- this file reprezent the left screen --}}

<form action="{{ route('categories.purge') }}" method="POST">
    @method('delete')
    @csrf
    <button class="purge-category">purge</button>
</form>
{{-- <span class="button is-success purge-category" style="margin-top: 12px;">purge</span> --}}
<ul class="category_ul">
    @forelse ($categories as $category)
    <li>
        {{-- <div class="title-container" style="margin-top: 30px">
            <span class="delete" style="margin-right: 10px" data-id="{{ $category->id }}">x</span>
        </div> --}}

        {{-- タイトルをajaxでupdateできる --}}
        <input class="title-update" style="cursor: context-menu;" type="text" value="{{ $category->title}}" name="updateTitle" onfocus="this.select();" data-id="{{ $category->id }}">

        <form action="{{ route('categories.destroy', $category)}}" method="POST">
            @csrf
            @method('DELETE')
            <button>[x]</button>
        </form>

        @error('update-title')
            <div class="error">{{ $message }}</div>
        @enderror

        <a class="show-category" href="{{ route('categories.show', $category) }}"><span style="font-size: 15px;">◀</span>recipe list<span style="font-size: 15px;">▶</span></a>
    </li>
    @empty
    <li>No categories yet!</li>
    @endforelse
</ul>

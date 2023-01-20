<x-layout>
    <x-slot name="left">
        <x-leftside :categories="$categories" />
    </x-slot>

    <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- if thre is no categories, right screen display nothing. --}}
    @if($categories->count() != 0)
        <span class="icon">
            <i class="fas fa-utensils fa-lg"></i>
        </span>
        <span style="font-size: 20px; margin-left: 10px;">{{ $categories[0]->title }}</span>

        <form method="post" action="{{ route('recipes.store', $categories[0]) }}" class="recipe-form">
            @csrf
            <p>add recipe</p>
            <input type="text" name="body">
        </form>

        <ul style="margin-top: 15px;">
            @foreach ($categories[0]->recipes as $recipe)
                <li>
                    {{-- <form method="post" action="{{ route('recipes.destroy', $categories[0], $recipe) }}" class="delete-comment"> --}}
                    <form method="post" action="{{ route('recipes.destroy', $recipe) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button>削除</button>
                    </form>
                    <span class="subtitle">
                        {{ $recipe->body }}
                    </span>
                </li>
            @endforeach
        </ul>
    {{-- @elseif ($categories->count() >= 2) --}}
    @endif
</x-layout>

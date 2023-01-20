<x-layout>
    <x-slot name="left">
        {{-- <x-leftside :posts="$posts" /> --}}
        <x-leftside :categories="$categories" />
    </x-slot>

        <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- if thre is no categories, right screen display nothing. --}}
    <h1>*List*  {{ $category->title }}</h1>

    <form method="post" action="{{ route('recipes.store', $category) }}" class="task-form">
    {{-- <form method="post" action="{{ route('recipes.store', $recipe) }}" class="task-form"> --}}
        @csrf
        <p>add recipe</p>
        <input type="text" name="body">
    </form>
    <ul>
        @foreach ($category->recipes as $recipe)
            <li>
                {{ $recipe->body }}
                <form method="post" action="{{ route('recipes.destroy', $category, $recipe) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf
                    <button class="btn">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>

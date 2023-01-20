{{-- step1ログイン時のみタスク追加ができるようにする --}}
{{-- step2 --}}

<h1>recipe list</h1>

@foreach ($recipes as $recipe)

    <p>{{ $recipe->body }}</p>

@endforeach

{{ $recipes->links('pagination.default') }}

@guest
    <p>You can add recipes if you sign in</p>
    <a href="{{ route('showLogin') }}">sign in form from here</a>
@endguest

@auth
    <a href="{{ route('categories.index') }}">mypage from here</a>
@endauth



@auth
    商品登録
    <form action="">
        <input type="text" name="" id="">
    </form>
@endauth

<p>please fill in your registerd email</p>


<form action="password-reset.email.send" method="POST">
    @csrf
    <div>
        <label for="email">メールアドレス</label>
        <input type="text" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <button>再設定用メールを送信</button>
</form>

<a href="{{ route('loginShow') }}">戻る</a>



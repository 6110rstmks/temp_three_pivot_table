<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link href={{ asset('css/app.css') }} rel="stylesheet">
</head>

<body>
    <script src="{{ asset('js/app.js') }}"></script>
    <a href="{{ route('showRegister') }}"><button>user registration is here</button></a>
    <a href="{{ route('recipes.list') }}"><button>recipe list is here</button></a>

    @if (session('login_error'))
        <div class="alert alert-success" style="color: red">
            {{ session('login_error') }}
        </div>
    @endif

    @if (session('logout_msg'))
        <div class="alert alert-success">
            {{ session('logout_msg') }}
        </div>
    @endif

    <div style="margin:0 auto; width: 500px;">

        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="inputEmail" class="sr-only">username</label>
            <input style="display: block; margin-top: 30px;" type="text" name="username" id="inputUserName" class="form-control" placeholder="Name" autofocus>

            <label for="inputPassword">Password</label>
            <input style="display: block" type="password" name="password" id="inputPassword" class="" placeholder="Password">

            <input type="checkbox" name="remember_me" value="true">

            <button style="display: block" type="submit">Login in</button>
        </form>

        <a href="{{ route('password_reset.email.form') }}">パスワードをお忘れの方</a>

    </div>

</body>
</html>

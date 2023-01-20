<h1>User Register</h1>

<div class="card-body">

    @auth
    <p style="display: inline">You are certificated.</p>
    <a href="{{ route('categories.index')}}"><button>Go to home</button></a>

    @endauth

    @guest
        <p>You are a guest now.</p>
    @endguest

    <form method="POST" action="{{ route('saveRegister') }}">
        @csrf



        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>


            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <div>email</div>
            <input type="email" name="email" id="">
        </div>


        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-conf" type="password" class="form-control" name="password_conf" required autocomplete="new-password">
            </div>
        </div>

        @if (session('match_error'))
            <div class="alert alert-success" style="color: red">
                {{ session('match_error') }}
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

    <a href="{{ route('showLogin') }}">user sign in is here</a>
</div>

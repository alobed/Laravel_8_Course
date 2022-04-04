<html lang="en">

<head>
    <title>Login/Sign Up Form</title>
    <link href="/login.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    
    <x-flash/>

    <div class="container" id="container">
        <!-- sign in page -->
        <div class="form-container sign-in-container">
            <form method="POST" action="/login" class="form" id="register">
                {{-- This to allow you to do the request
                this will be generated to a hidden input hold a token that laravel has been generated and it will be checked
                This is a try to prevent you from (Cross-Side Request Forgery Attack) --}}
                @csrf
                <h1 class="form__title">Login</h1>

                <div class="form__input-group">
                    <label for="email"> Email: </label>
                    <input type="text" class="form__input" name="email" id="email" maxlength="20" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form__input-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form__input" name="password" id="password" maxlength="20" required>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <button class="form__button" type="submit">Login</button>

                {{-- @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class='text-red-500 text-xs' >{{ $error }}</li>
                    @endforeach
                </ul>
                @endif --}}
            </form>
        </div>

        <!--  create account page -->
        <div class="form-container sign-up-container">
            <form method="POST" action="/register" class="form" id="register">
                {{-- This to allow you to do the request
                this will be generated to a hidden input hold a token that laravel has been generated and it will be checked
                This is a try to prevent you from (Cross-Side Request Forgery Attack) --}}
                @csrf
                <h1 class="form__title">Register</h1>

                <div class="form__input-group">
                    <label for="username"> Username: </label>
                    <input type="text" class="form__input" name="username" id="username" maxlength="20" value="{{ old('username') }}"  required>
                    @error('username')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form__input-group">
                    <label for="email"> Email: </label>
                    <input type="text" class="form__input" name="email" id="email" maxlength="20" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form__input-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form__input" name="password" id="password" maxlength="20" required>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <button class="form__button" type="submit">Submit</button>

                {{-- @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class='text-red-500 text-xs' >{{ $error }}</li>
                    @endforeach
                </ul>
                @endif --}}
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/main.js"></script>

</body>

</html>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components/header')
    <body class="antialiased">
        @include('components/navbar')
        <div class="hero-container" style="background-image: url({{ asset('img/hero.jpg') }});">    
            <form class='form-container' action="{{ route('signup') }}" method="post">
                {{csrf_field()}}
                <h1> Register </h1></br>
                <label> Username: </label></br>
                <input type="text" name="username" /> </br>
                <label> Password: </label></br>
                <input type="password" name="password" /> </br>
                <label> Re-enter Password: </label></br>
                <input type="password" name="validation_password" /> </br>
                <label> Email: </label></br>
                <input type="email" name="email" /> </br>
                <button class='large-button' type="submit" action="">Sign Up</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </body>
</html>
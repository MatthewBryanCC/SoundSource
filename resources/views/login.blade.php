<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components/header')
    <body class="antialiased">
        <div>
            @include('components/navbar')
            <div class="hero-container relative items-top justify-center sm:items-center" style="background-image: url({{ asset('img/hero3.jpg') }});">
                <form class='form-container' action="{{ route('login') }}" method="post">
                    {{csrf_field()}}
                    <h1> Login </h1>
                    <label>Email:</label></br>
                    <input type="email" name="email" /></br>
                    <label>Password</label></br>
                    <input type="password" name="password" /></br>
                    <label> Remember Me </label> 
                    <input type="checkbox" name="remember" id="remember"/></br>
                    <button type="submit" class="large-button"> Login </button>
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
        </div>
    </body>
</html>

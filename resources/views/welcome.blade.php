<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components/header')
    <body class="antialiased">
        <div>
            @include('components/navbar')
            <div class="hero-container relative flex items-top justify-center sm:items-center" style="background-image: url({{ asset('img/hero2.jpg') }});">
                <div class='hero-info-container animated fadeInUp'>
                    <h1 class="hero-title"> Sound Source </h1>
                    <h3> A digital audio storage management solution. </h3>
                    <h3> Get started today with a free account! </h3>
                    @if(isset($user))
                        <button class='large-button' onclick="location.href='{{ url('dashboard') }}'"> View Dashboard </button>
                    @else
                        <button class='large-button' onclick="location.href='{{ url('signup') }}'"> Sign Up </button>
                    @endif
                </div>
            </div>  
        </div>
    </body>
</html>

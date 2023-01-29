<div id="Navbar">
    <ul class="nav-list">
        @if(!auth()->guard()->check())
            <li class="nav-item"><a href="{{ url('login') }}"><i class="fa fa-user" aria-hidden="true"></i> Login </a></li>
            <li class="nav-item"><a href="{{ url('signup') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register </a></li>
        @else
            @if(isset($user->name))
                <p style="display: inline-block; margin-right: 10px;">Welcome, {{ $user->name }}</p>
            @endif
            <li class="nav-item"><a href="#" id="Upload-Button"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload </a></li>
            <li class="nav-item"><a href="{{url('/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a></li>
        @endif
    </ul>
    <span class="nav-title" onclick="location.href='{{ url('/') }}'"> Sound Source </span>
</div>

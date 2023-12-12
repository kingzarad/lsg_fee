<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LSG FEE')</title>
    @include('layouts.libs.csslib')

</head>

<body>
    @include('layouts.navbar')
    @auth('web')
        {{-- Administrator --}}
        @include('layouts.sidebar')

        <div class="main">
            <div id="main-wrapper">
                @yield('content')
            </div>
        </div>
    @elseif(auth()->guard('students')->check())
        <div class="main">

            @yield('content')
        </div>
    @else
        {{-- Not authenticated (Guest) --}}
        <div class="main">
            @yield('content')
        </div>
    @endauth
    @include('layouts.libs.jslib')
</body>

</html>

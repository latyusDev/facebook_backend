<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Posty</title>

</head>
<body class="bg-gray-100">
    <nav class="p-6 bg-white flex justify-between mb-9 ">

        <ul class="flex items-center">
            <li><a href="/" class="p-3">Home</a></li>
            <li><a href="{{ route('dashboard')}} " class="p-3">Dashboard</a></li>
            <li><a href="{{ route('posts')}}" class="p-3">Post</a></li>
        </ul>

        {{-- account --}}

        <ul class="flex items-center">
            @auth
            <li><a href="" class="p-3">{{ auth()->user()->name}}</a></li>
                <form action="/logout" method="post">
                 @csrf
                 <button type="submit">Logout</button>
                </form>                
            @endauth

            @guest
            <li><a href=" {{route('login')}} " class="p-3">Login</a></li>
            <li><a href="{{ route('register') }}" class="p-3">Register</a></li>
            @endguest
                
        </ul>
    </nav>
    @yield('content')
</body>
</html>
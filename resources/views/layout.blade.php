<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Job Portal')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }

        nav { background: #333; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-left: 1rem; }
        nav a:hover { text-decoration: underline; }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }

        .card { background: white; padding: 2rem; margin: 1rem 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }

        .btn { padding: 0.5rem 1rem; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-success { background: #28a745; }

        input, textarea, select { width: 100%; padding: 0.5rem; margin: 0.5rem 0; border: 1px solid #ddd; border-radius: 4px; }

        .alert { padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        table { width: 100%; border-collapse: collapse; }
        table th, table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background: #f8f9fa; font-weight: bold; }
    </style>
</head>
<body>
    <nav>
        <div><a href="/" style="font-size: 1.5rem; font-weight: bold; margin: 0;">Job Portal</a></div>
        <div>
            @auth
                <span>Hello, {{ auth()->user()->name }}</span>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.jobs') }}">Manage Jobs</a>
                @else
                    <a href="{{ route('my.applications') }}">My Applications</a>
                @endif
                <a href="{{ route('logout') }}">Logout</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>

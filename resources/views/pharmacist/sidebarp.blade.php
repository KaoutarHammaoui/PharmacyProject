{{-- resources/views/components/sidebar.blade.php --}}
<aside class="sidebar bg-gray-800 text-white w-64 min-h-screen p-4">
    <div class="sidebar-header mb-8">
        <h2 class="text-xl font-bold">{{ config('app.name', 'Laravel') }}</h2>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="space-y-2">
            <li>
                <a href="" 
                   class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            
            <li>
                <a href="" 
                   class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Users
                </a>
            </li>
            
            <li>
                <a href="" 
                   class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('posts.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                    </svg>
                    Posts
                </a>
            </li>
            
            
        </ul>
        
        <div class="mt-8 pt-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logOut') }}">
                @csrf
                <button type="submit" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 text-red-400 hover:text-red-300 w-full text-left">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- Usage in your main layout (resources/views/layouts/app.blade.php) --}}
{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex">
        <x-sidebar />
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
--}}

{{-- Alternative: Include directly in your view --}}
{{--
@extends('layouts.app')

@section('content')
<div class="flex">
    @include('components.sidebarp')
    <div class="flex-1 p-6">
        <!-- Your main content here -->
    </div>
</div>
@endsection
--}}
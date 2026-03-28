<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TutorLink') }}</title>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: #f4f6fb;
        }

        /* ── Sidebar ── */
        .tl-sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e8eaf0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 40;
        }

        .tl-sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid #f0f2f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tl-logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 800;
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
        }

        .tl-logo-text {
            font-size: 17px;
            font-weight: 800;
            color: #1e1b4b;
            letter-spacing: -0.3px;
        }

        .tl-logo-text span {
            color: #4f46e5;
        }

        .tl-sidebar-nav {
            padding: 20px 12px;
            flex: 1;
        }

        .tl-nav-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0 12px;
            margin: 16px 0 8px;
        }

        .tl-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 2px;
            transition: all 0.2s;
        }

        .tl-nav-item:hover {
            background: #f0f0ff;
            color: #4f46e5;
        }

        .tl-nav-item.active {
            background: linear-gradient(135deg, #eef2ff, #f0f0ff);
            color: #4f46e5;
            box-shadow: inset 3px 0 0 #4f46e5;
        }

        .tl-nav-item svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
        }

        .tl-sidebar-footer {
            padding: 16px;
            border-top: 1px solid #f0f2f8;
        }

        .tl-user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #f8f9ff;
            cursor: pointer;
        }

        .tl-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 14px;
        }

        .tl-user-name {
            font-size: 13px;
            font-weight: 700;
            color: #1e1b4b;
        }

        .tl-user-role {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 500;
        }

        /* ── Top Header ── */
        .tl-topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e8eaf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 30;
        }

        .tl-topbar-title {
            font-size: 18px;
            font-weight: 800;
            color: #1e1b4b;
        }

        .tl-topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tl-icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: #f4f6fb;
            border: 1px solid #e8eaf0;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            color: #6b7280;
        }

        .tl-icon-btn:hover {
            background: #eef2ff;
            color: #4f46e5;
            border-color: #c7d2fe;
        }

        .tl-badge {
            position: absolute;
            top: -4px; right: -4px;
            width: 18px; height: 18px;
            background: #ef4444;
            border-radius: 50%;
            font-size: 10px;
            font-weight: 800;
            color: white;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid white;
        }

        .tl-login-btn {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 8px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
            transition: all 0.2s;
        }

        .tl-login-btn:hover {
            box-shadow: 0 6px 20px rgba(79,70,229,0.4);
            transform: translateY(-1px);
        }

        /* ── Main Content ── */
        .tl-main {
            margin-left: 260px;
            padding-top: 64px;
            min-height: 100vh;
        }

        .tl-content {
            padding: 32px 28px;
        }

        /* ── Stat Cards ── */
        .tl-stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            border: 1px solid #e8eaf0;
            transition: all 0.2s;
        }

        .tl-stat-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .tl-stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }

        .tl-stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1e1b4b;
            line-height: 1;
        }

        .tl-stat-label {
            font-size: 13px;
            color: #9ca3af;
            font-weight: 500;
            margin-top: 4px;
        }

        /* ── Welcome Banner ── */
        .tl-welcome-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 20px;
            padding: 28px 32px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 28px;
        }

        .tl-welcome-banner::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }

        .tl-welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 80px;
            width: 150px; height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .tl-welcome-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .tl-welcome-sub {
            font-size: 14px;
            opacity: 0.8;
            font-weight: 500;
        }

        /* ── AI Widget ── */
        #ai-chat-window {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .tl-sidebar { transform: translateX(-100%); }
            .tl-topbar { left: 0; }
            .tl-main { margin-left: 0; }
        }
    </style>
</head>

<body>
    {{-- ════════════════════════════════
         SIDEBAR
    ════════════════════════════════ --}}
    <aside class="tl-sidebar">
        {{-- Logo --}}
        <div class="tl-sidebar-logo">
            <div class="tl-logo-icon">T</div>
            <div class="tl-logo-text">Tutor<span>Link</span></div>
        </div>

        {{-- Navigation --}}
        <nav class="tl-sidebar-nav">
            @auth
                @if(auth()->user()->role === 'admin')
                    {{-- ADMIN NAV --}}
                    <div class="tl-nav-label">Overview</div>
                    <a href="{{ route('admin.dashboard') }}"
                       class="tl-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

            
                    <a href=""
                       class="tl-nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0120 9.414V19a2 2 0 01-2 2z"/>
                        </svg>
                        Reports
                    </a>

                    <div class="tl-nav-label">Management</div>
                    <a href=""
                       class="tl-nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Users
                    </a>
                    <a href=""
                       class="tl-nav-item {{ request()->routeIs('admin.courses') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Courses
                    </a>

                    <div class="tl-nav-label">Communication</div>
                    <a href="/conversations"
                       class="tl-nav-item {{ request()->is('conversations*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Messages
                        @php
                            $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-black rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>

                @else
                    {{-- STUDENT/TUTOR NAV --}}
                    <div class="tl-nav-label">Main</div>
                    <a href="{{ route('dashboard') }}"
                       class="tl-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('subjects.index') }}"
                       class="tl-nav-item {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        My Courses
                    </a>
                    
                    <a href="{{ route('store.index') }}"
                       class="tl-nav-item {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Digital Store
                    </a>
                    <a href="{{ route('student.my-posts') }}"
                       class="tl-nav-item {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        My Posts
                    </a>
                    
                    {{-- <a href="{{ route('timetable.index') }}"
                       class="tl-nav-item {{ request()->routeIs('timetable.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Timetable
                    </a> --}}
                    
                    <a href="/conversations"
                       class="tl-nav-item {{ request()->is('conversations*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Messages
                        @php
                            $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-black rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="tl-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        My Profile
                    </a>
                @endif
            @endauth
        </nav>

        {{-- User Card --}}
        @auth
        <div class="tl-sidebar-footer">
            <div class="tl-user-card">
                <div class="tl-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="tl-user-name truncate">{{ auth()->user()->name }}</div>
                    <div class="tl-user-role">{{ ucfirst(auth()->user()->role ?? 'Student') }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout"
                        class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </aside>

    {{-- ════════════════════════════════
         TOP BAR
    ════════════════════════════════ --}}
    <header class="tl-topbar">
        <div class="tl-topbar-title">
            @isset($pageTitle)
                {{ $pageTitle }}
            @else
                {{ config('app.name', 'TutorLink') }}
            @endisset
        </div>

        <div class="tl-topbar-right">
            @auth
                {{-- Messages Icon --}}
                @php
                    $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
                @endphp
                <a href="/conversations" class="tl-icon-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    @if($unreadCount > 0)
                        <span class="tl-badge">{{ $unreadCount }}</span>
                    @endif
                </a>

                {{-- Profile dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition">
                            <div class="tl-avatar" style="width:28px;height:28px;font-size:12px;border-radius:8px">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-700 text-indigo-900" style="font-weight:700">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile Settings</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="tl-login-btn">Login</a>
            @endauth
        </div>
    </header>

    {{-- ════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════ --}}
    <div class="tl-main">
        @isset($header)
            <div style="padding: 24px 28px 0; border-bottom: 1px solid #e8eaf0; background: white; margin-bottom: 0;">
                {{ $header }}
            </div>
        @endisset

        <main class="tl-content">
            {{ $slot }}
        </main>
    </div>

    {{-- ════════════════════════════════
         AI FLOATING WIDGET
    ════════════════════════════════ --}}
    <div id="ai-widget-container" class="fixed bottom-6 right-6 z-[100]" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        {{-- Chat Window --}}
        <div id="ai-chat-window"
            class="hidden mb-4 overflow-hidden flex flex-col"
            style="width:340px; background:white; border-radius:20px; box-shadow:0 20px 60px rgba(79,70,229,0.15); border:1px solid #e8eaf0;">

            {{-- Header --}}
            <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed); padding:16px 20px; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:34px;height:34px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;">🤖</div>
                    <div>
                        <div style="color:white;font-weight:800;font-size:13px;letter-spacing:0.5px;">TutorLink AI</div>
                        <div style="color:rgba(255,255,255,0.7);font-size:11px;font-weight:500;">Always here to help</div>
                    </div>
                </div>
                <button onclick="toggleAIChat()"
                    style="background:rgba(255,255,255,0.15);border:none;width:28px;height:28px;border-radius:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:white;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-width="2.5"/>
                    </svg>
                </button>
            </div>

            {{-- Messages --}}
            <div id="ai-messages"
                style="height:300px;overflow-y:auto;padding:16px;display:flex;flex-direction:column;gap:12px;background:#f8f9ff;">
                <div style="background:white;padding:12px 14px;border-radius:14px;border-radius-top-left:4px;border:1px solid #e8eaf0;font-size:13px;color:#374151;font-weight:500;max-width:85%;">
                    👋 Hi! I'm TutorLink AI. Ask me anything about your courses or studies!
                </div>
            </div>

            {{-- Input --}}
            <div style="padding:14px 16px;border-top:1px solid #f0f2f8;background:white;">
                <div style="display:flex;gap:8px;align-items:center;">
                    <input type="text" id="ai-user-input" placeholder="Ask anything..."
                        style="flex:1;padding:10px 14px;background:#f4f6fb;border:1px solid #e8eaf0;border-radius:12px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:500;outline:none;color:#1e1b4b;">
                    <button onclick="sendAIMessage()"
                        style="width:38px;height:38px;background:linear-gradient(135deg,#4f46e5,#7c3aed);border:none;border-radius:12px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 12px rgba(79,70,229,0.3);">
                        <svg width="16" height="16" fill="white" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Toggle Button --}}
        <button onclick="toggleAIChat()"
            style="display:flex;align-items:center;gap:8px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:white;padding:14px 20px;border-radius:50px;border:none;cursor:pointer;box-shadow:0 8px 24px rgba(79,70,229,0.4);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:13px;letter-spacing:0.3px;transition:all 0.3s;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2.5"/>
            </svg>
            Chat with AI
        </button>
    </div>

    <script>
        function toggleAIChat() {
            const windowEl = document.getElementById('ai-chat-window');
            windowEl.classList.toggle('hidden');
        }

        async function sendAIMessage() {
            const input = document.getElementById('ai-user-input');
            const msgContainer = document.getElementById('ai-messages');
            const query = input.value.trim();
            if (!query) return;

            // User bubble
            msgContainer.innerHTML += `
                <div style="display:flex;justify-content:flex-end;">
                    <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:white;padding:10px 14px;border-radius:14px;border-top-right-radius:4px;font-size:13px;font-weight:500;max-width:85%;">
                        ${query}
                    </div>
                </div>`;
            input.value = '';
            msgContainer.scrollTop = msgContainer.scrollHeight;

            // Loading
            const loadingId = "loading-" + Date.now();
            msgContainer.innerHTML += `
                <div id="${loadingId}" style="display:flex;gap:6px;padding:8px 0;">
                    <div style="width:8px;height:8px;background:#c7d2fe;border-radius:50%;animation:bounce 1.2s infinite 0s;"></div>
                    <div style="width:8px;height:8px;background:#c7d2fe;border-radius:50%;animation:bounce 1.2s infinite 0.2s;"></div>
                    <div style="width:8px;height:8px;background:#c7d2fe;border-radius:50%;animation:bounce 1.2s infinite 0.4s;"></div>
                </div>`;
            msgContainer.scrollTop = msgContainer.scrollHeight;

            try {
                const response = await fetch("{{ route('ai.process') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({ user_prompt: query })
                });

                const data = await response.json();
                const loadingEl = document.getElementById(loadingId);
                if (loadingEl) loadingEl.remove();

                if (response.ok && data.ai_response) {
                    msgContainer.innerHTML += `
                        <div style="background:white;padding:10px 14px;border-radius:14px;border-top-left-radius:4px;border:1px solid #e8eaf0;font-size:13px;color:#374151;font-weight:500;max-width:85%;">
                            ${data.ai_response}
                        </div>`;
                } else {
                    msgContainer.innerHTML += `<div style="color:#ef4444;font-size:12px;">Error: ${data.error || 'Something went wrong'}</div>`;
                }
            } catch (error) {
                const loadingEl = document.getElementById(loadingId);
                if (loadingEl) loadingEl.remove();
                msgContainer.innerHTML += `<div style="color:#ef4444;font-size:12px;">Connection error. Please try again.</div>`;
            }

            msgContainer.scrollTop = msgContainer.scrollHeight;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('ai-user-input');
            if (input) {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') { e.preventDefault(); sendAIMessage(); }
                });
            }
        });
    </script>

    <style>
        @keyframes bounce {
            0%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-8px); }
        }
    </style>
</body>
</html>
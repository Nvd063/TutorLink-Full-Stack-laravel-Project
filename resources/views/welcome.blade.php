<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorLink | Find Your Perfect Tutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-900">

    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="text-2xl font-black tracking-tighter text-indigo-600">
                Tutor<span class="text-slate-900">Link</span>
            </div>

            <div class="hidden md:flex items-center space-x-8 font-semibold">
                <a href="/subjects" class="text-slate-600 hover:text-indigo-600 transition">Subjects</a>
                <a href="/tutors" class="text-slate-600 hover:text-indigo-600 transition">Find Tutors</a>
                
                <div class="flex items-center gap-4 border-l border-slate-200 pl-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Sign Up Free</a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="relative pt-20 pb-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <span class="inline-block py-1 px-4 rounded-full bg-indigo-100 text-indigo-700 text-sm font-bold mb-6 tracking-wide uppercase">
                    🚀 Smart Learning Platform
                </span>
                <h1 class="text-6xl md:text-7xl font-black leading-tight mb-8">
                    Find the Best <span class="text-indigo-600">Tutors</span> <br> for Your Future
                </h1>
                <p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Personalized 1-on-1 lessons. Over 500+ verified experts ready to help you master any subject.
                </p>

                <form action="/tutors/search" method="GET" class="relative max-w-3xl mx-auto group">
                    <div class="relative flex items-center">
                        <svg class="absolute left-6 w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="query" placeholder="Search by subject (e.g. Mathematics, Physics...)" 
                               class="w-full pl-16 pr-44 py-7 rounded-3xl border-2 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-50/50 shadow-2xl transition-all outline-none text-lg font-medium">
                        <button type="submit" class="absolute right-4 bg-indigo-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg active:scale-95">
                            Search Now
                        </button>
                    </div>
                </form>
            </div>

            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200 rounded-full blur-[150px] opacity-30 -z-10"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200 rounded-full blur-[150px] opacity-30 -z-10"></div>
        </section>

        <section class="max-w-7xl mx-auto px-6 mb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-100">
                <div class="text-center p-6">
                    <h3 class="text-5xl font-black text-slate-900">500+</h3>
                    <p class="text-slate-500 mt-2 font-semibold">Expert Tutors</p>
                </div>
                <div class="text-center p-6 border-y md:border-y-0 md:border-x border-slate-100">
                    <h3 class="text-5xl font-black text-slate-900">10k+</h3>
                    <p class="text-slate-500 mt-2 font-semibold">Active Students</p>
                </div>
                <div class="text-center p-6">
                    <h3 class="text-5xl font-black text-slate-900">4.9/5</h3>
                    <p class="text-slate-500 mt-2 font-semibold">Student Satisfaction</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-12 border-t border-slate-200 text-center text-slate-500 font-medium">
        <p>&copy; 2026 TutorLink. All rights reserved.</p>
    </footer>

</body>
</html>
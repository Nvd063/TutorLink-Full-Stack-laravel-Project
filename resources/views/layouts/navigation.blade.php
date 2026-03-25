<div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">

    @auth
        <div class="relative flex items-center">
            <a href="/conversations" class="p-2 text-gray-400 hover:text-indigo-600 transition relative">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>

                @php
                    // Sirf wo messages jo current user ko mile hain aur abhi tak parhay nahi gaye
                    $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                @endphp

                @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 flex h-5 w-5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-5 w-5 bg-red-600 text-white text-[10px] font-black flex items-center justify-center border-2 border-white">
                            {{ $unreadCount }}
                        </span>
                    </span>
                @endif
            </a>
        </div>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-700 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile Settings') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    @else
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600">Log in</a>
            <a href="{{ route('register') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">Register</a>
        </div>
    @endauth

</div>
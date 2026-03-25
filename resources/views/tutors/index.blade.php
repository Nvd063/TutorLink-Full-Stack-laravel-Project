<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Tutors | TutorLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 antialiased">

    <nav class="bg-white border-b shadow-sm mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-indigo-600 tracking-tight">TutorLink</a>
            <div class="flex items-center gap-6">
                {{-- <a href="/dashboard" class="text-gray-600 font-medium hover:text-indigo-600 transition">Dashboard</a> --}}
                <a href="/"
                    class="bg-indigo-500 text-white font-semibold px-5 py-2 rounded-lg hover:bg-indigo-600 transition shadow">Home</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">

            <aside class="w-full md:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="text-lg font-bold mb-4">Filters</h3>

                    <form id="filterForm" action="/tutors" method="GET" class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Search
                                Subject</label>
                            <div class="relative">
                                <input type="text" id="subjectAjaxInput" autocomplete="off"
                                    placeholder="Type Subject (e.g. PHP)"
                                    class="w-full rounded-xl border-slate-200 focus:border-indigo-600 focus:ring-0 shadow-sm p-3">
                                <div id="subjectSuggestions"
                                    class="absolute z-50 w-full bg-white shadow-2xl rounded-xl mt-1 border border-slate-100 hidden max-h-48 overflow-y-auto">
                                </div>
                            </div>
                            <input type="hidden" name="subject" id="hiddenSubject">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Max Price: $<span
                                    id="priceValue">{{ request('max_price', 50) }}</span></label>
                            <input type="range" name="max_price" id="priceRange" class="w-full accent-indigo-600"
                                min="10" max="50" step="5" value="{{ request('max_price', 50) }}">
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>$10</span>
                                <span>$50+</span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                            Apply Filters
                        </button>

                        @if(request()->anyFilled(['subject', 'max_price']))
                            <a href="{{ url('/tutors') }}"
                                class="block text-center text-xs text-red-500 font-bold uppercase mt-2 italic hover:underline">Clear
                                Filters</a>
                        @endif
                    </form>
                </div>
            </aside>

            <main class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-black text-gray-900">Available Tutors</h2>
                    <span class="text-sm text-gray-500 font-medium">Showing all results</span>
                </div>

                <div id="tutors-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @include('tutors.partials.tutor_cards')
                </div>
            </main>
        </div>
    </div>

    <script>
        // ================================
        // ELEMENTS
        // ================================
        const subjectInput = document.getElementById('subjectAjaxInput');
        const suggestionsBox = document.getElementById('subjectSuggestions');
        const hiddenSubject = document.getElementById('hiddenSubject');
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');

        // ================================
        // 1. PRICE FILTER (Already OK)
        // ================================
        if (priceRange) {
            priceRange.addEventListener('input', function () {
                priceValue.textContent = this.value;
                fetchTutors();
            });
        }

        // ================================
        // 2. DEBOUNCE (IMPORTANT 🔥)
        // ================================
        let debounceTimer;
        function debounce(callback, delay = 400) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(callback, delay);
        }

        // ================================
        // 3. SUBJECT INPUT (MAIN FIX)
        // ================================
        subjectInput.addEventListener('input', function () {
            let query = this.value.trim();

            // Hidden field sync (IMPORTANT)
            hiddenSubject.value = query;

            // 🔥 MAIN: Tutors ko har typing pe update karo (debounced)
            debounce(() => {
                fetchTutors();
            });

            // ========================
            // Suggestions API
            // ========================
            if (query.length >= 2) {
                fetch(`/api/subjects/search?q=${query}`)
                    .then(res => res.json())
                    .then(data => {
                        suggestionsBox.innerHTML = '';

                        if (data.length > 0) {
                            suggestionsBox.classList.remove('hidden');

                            data.forEach(subject => {
                                let div = document.createElement('div');
                                div.className = 'p-3 hover:bg-indigo-50 cursor-pointer font-bold text-slate-700 border-b last:border-0';
                                div.innerText = subject.name;

                                div.onclick = function () {
                                    subjectInput.value = subject.name;
                                    hiddenSubject.value = subject.name;
                                    suggestionsBox.classList.add('hidden');

                                    fetchTutors(); // exact match filter
                                };

                                suggestionsBox.appendChild(div);
                            });

                        } else {
                            suggestionsBox.classList.add('hidden');
                        }
                    });
            } else {
                suggestionsBox.classList.add('hidden');
            }
        });

        // ================================
        // 4. FETCH TUTORS (CORE FUNCTION)
        // ================================
        function fetchTutors() {
            const form = document.getElementById('filterForm');
            const container = document.getElementById('tutors-container');

            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            container.style.opacity = '0.5';

            fetch(`/tutors?${params}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;
                    container.style.opacity = '1';
                });
        }

        // ================================
        // 5. CLICK OUTSIDE HIDE DROPDOWN
        // ================================
        document.addEventListener('click', (e) => {
            if (!subjectInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Tutors | TutorLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        body { background: #f4f6fb; margin: 0; }

        /* ── Navbar ── */
        .tl-nav {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid #e8eaf0;
            position: sticky; top: 0; z-index: 50;
        }
        .tl-nav-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 0 28px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .tl-logo {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .tl-logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 900; font-size: 17px;
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
        }
        .tl-logo-text { font-size: 17px; font-weight: 800; color: #1e1b4b; }
        .tl-logo-text span { color: #4f46e5; }
        .tl-nav-btn {
            display: inline-flex; align-items: center; gap: 6px;
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            color: white; text-decoration: none;
            padding: 9px 20px; border-radius: 10px;
            font-size: 13px; font-weight: 700;
            box-shadow: 0 4px 12px rgba(79,70,229,0.25);
            transition: all .2s;
        }
        .tl-nav-btn:hover { box-shadow: 0 6px 20px rgba(79,70,229,0.4); transform: translateY(-1px); }

        /* ── Page Header ── */
        .tl-page-header {
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            padding: 40px 28px;
            position: relative; overflow: hidden;
        }
        .tl-page-header::before {
            content: '';
            position: absolute; top: -80px; right: -80px;
            width: 280px; height: 280px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .tl-page-header::after {
            content: '';
            position: absolute; bottom: -60px; left: 40%;
            width: 180px; height: 180px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .tl-page-header-inner {
            max-width: 1280px; margin: 0 auto;
            position: relative; z-index: 1;
        }
        .tl-page-title {
            font-size: 28px; font-weight: 900;
            color: white; margin-bottom: 6px;
            letter-spacing: -0.5px;
        }
        .tl-page-sub { font-size: 14px; color: rgba(255,255,255,0.75); font-weight: 500; }

        /* ── Layout ── */
        .tl-layout {
            max-width: 1280px; margin: 0 auto;
            padding: 28px 28px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Sidebar Filter ── */
        .tl-sidebar {
            background: white;
            border-radius: 20px;
            border: 1px solid #e8eaf0;
            overflow: hidden;
            position: sticky;
            top: 84px;
        }
        .tl-sidebar-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f2f8;
            display: flex; align-items: center; justify-content: space-between;
        }
        .tl-sidebar-title { font-size: 15px; font-weight: 800; color: #1e1b4b; }
        .tl-sidebar-body { padding: 20px 22px; }

        .tl-filter-label {
            display: block;
            font-size: 11px; font-weight: 800;
            color: #9ca3af; text-transform: uppercase;
            letter-spacing: .6px; margin-bottom: 8px;
        }
        .tl-filter-group { margin-bottom: 22px; }

        /* Subject Input */
        .tl-input-wrap { position: relative; }
        .tl-input-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .tl-input {
            width: 100%;
            background: #f4f6fb;
            border: 1px solid #e8eaf0;
            border-radius: 12px;
            padding: 11px 14px 11px 38px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px; font-weight: 600;
            color: #1e1b4b; outline: none;
            transition: border-color .2s;
        }
        .tl-input:focus { border-color: #a5b4fc; box-shadow: 0 0 0 3px rgba(79,70,229,0.08); }
        .tl-input::placeholder { color: #9ca3af; font-weight: 500; }

        /* Suggestions Dropdown */
        .tl-suggestions {
            position: absolute; z-index: 100;
            width: 100%; top: calc(100% + 6px);
            background: white;
            border-radius: 12px;
            border: 1px solid #e8eaf0;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
            overflow: hidden;
            display: none;
            max-height: 200px;
            overflow-y: auto;
        }
        .tl-suggestion-item {
            padding: 10px 14px;
            font-size: 13px; font-weight: 600;
            color: #374151; cursor: pointer;
            border-bottom: 1px solid #f4f6fb;
            transition: all .15s;
        }
        .tl-suggestion-item:last-child { border-bottom: none; }
        .tl-suggestion-item:hover { background: #eef2ff; color: #4f46e5; }

        /* Price Range */
        .tl-price-display {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 10px;
        }
        .tl-price-val {
            font-size: 18px; font-weight: 900; color: #4f46e5;
        }
        .tl-price-unit { font-size: 12px; color: #9ca3af; font-weight: 600; }
        input[type=range] {
            -webkit-appearance: none;
            width: 100%; height: 6px;
            border-radius: 50px;
            background: #e8eaf0;
            outline: none; cursor: pointer;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px; height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            box-shadow: 0 2px 8px rgba(79,70,229,0.4);
            cursor: pointer;
        }
        .tl-range-labels {
            display: flex; justify-content: space-between;
            font-size: 11px; color: #9ca3af; font-weight: 600;
            margin-top: 8px;
        }

        /* Filter Buttons */
        .tl-btn-apply {
            width: 100%;
            background: linear-gradient(135deg,#4f46e5,#7c3aed);
            color: white; border: none; cursor: pointer;
            padding: 13px; border-radius: 12px;
            font-size: 13px; font-weight: 800;
            font-family: 'Plus Jakarta Sans',sans-serif;
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
            transition: all .2s;
            margin-bottom: 10px;
        }
        .tl-btn-apply:hover { box-shadow: 0 6px 20px rgba(79,70,229,0.4); transform: translateY(-1px); }
        .tl-btn-clear {
            display: block; width: 100%; text-align: center;
            font-size: 12px; font-weight: 700;
            color: #ef4444; text-decoration: none;
            padding: 8px; border-radius: 10px;
            background: #fff5f5;
            transition: all .2s;
        }
        .tl-btn-clear:hover { background: #fee2e2; }

        /* ── Main Content ── */
        .tl-main-header {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tl-results-title { font-size: 18px; font-weight: 900; color: #1e1b4b; }
        .tl-results-count {
            font-size: 12px; color: #9ca3af; font-weight: 600;
            background: white; border: 1px solid #e8eaf0;
            padding: 6px 14px; border-radius: 50px;
        }

        /* ── Tutors Grid ── */
        #tutors-container {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 18px;
            transition: opacity .3s;
        }

        /* Loading shimmer */
        .tl-loading { opacity: 0.5; pointer-events: none; }

        @media(max-width:900px) {
            .tl-layout { grid-template-columns: 1fr; }
            .tl-sidebar { position: static; }
            #tutors-container { grid-template-columns: 1fr; }
        }
        @media(max-width:600px) {
            .tl-page-header { padding: 28px 20px; }
            .tl-layout { padding: 20px 16px; }
        }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══ --}}
<nav class="tl-nav">
    <div class="tl-nav-inner">
        <a href="/" class="tl-logo">
            <div class="tl-logo-icon">T</div>
            <span class="tl-logo-text">Tutor<span>Link</span></span>
        </a>
        <div style="display:flex;align-items:center;gap:12px;">
            @auth
                <a href="{{ url('/dashboard') }}" class="tl-nav-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
            @else
                <a href="/" class="tl-nav-btn">← Home</a>
            @endauth
        </div>
    </div>
</nav>

{{-- ══ PAGE HEADER ══ --}}
<div class="tl-page-header">
    <div class="tl-page-header-inner">
        <div class="tl-page-title">Find Your Perfect Tutor</div>
        <div class="tl-page-sub">Browse from 500+ verified tutors across all subjects</div>
    </div>
</div>

{{-- ══ MAIN LAYOUT ══ --}}
<div class="tl-layout">

    {{-- ── Sidebar Filters ── --}}
    <aside class="tl-sidebar">
        <div class="tl-sidebar-header">
            <span class="tl-sidebar-title">
                <svg style="display:inline;width:16px;height:16px;margin-right:6px;vertical-align:-2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                Filters
            </span>
            @if(request()->anyFilled(['subject','max_price']))
                <a href="{{ url('/tutors') }}" class="tl-btn-clear" style="width:auto;padding:4px 12px;font-size:11px;">
                    Clear All
                </a>
            @endif
        </div>

        <div class="tl-sidebar-body">
            <form id="filterForm" action="/tutors" method="GET">

                {{-- Subject Search --}}
                <div class="tl-filter-group">
                    <label class="tl-filter-label">Search by Subject</label>
                    <div class="tl-input-wrap">
                        <svg class="tl-input-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="subjectAjaxInput" autocomplete="off"
                            placeholder="e.g. PHP, Python, Math..."
                            value="{{ request('subject') }}"
                            class="tl-input">
                        <div id="subjectSuggestions" class="tl-suggestions"></div>
                    </div>
                    <input type="hidden" name="subject" id="hiddenSubject" value="{{ request('subject') }}">
                </div>

                {{-- Price Range --}}
                <div class="tl-filter-group">
                    <label class="tl-filter-label">Max Price per Hour</label>
                    <div class="tl-price-display">
                        <div>
                            <span class="tl-price-val">$<span id="priceValue">{{ request('max_price', 50) }}</span></span>
                        </div>
                        <span class="tl-price-unit">per hour</span>
                    </div>
                    <input type="range" name="max_price" id="priceRange"
                        min="10" max="50" step="5"
                        value="{{ request('max_price', 50) }}">
                    <div class="tl-range-labels">
                        <span>$10</span>
                        <span>$30</span>
                        <span>$50+</span>
                    </div>
                </div>

                {{-- Apply --}}
                <button type="submit" class="tl-btn-apply">
                    Apply Filters
                </button>

                @if(request()->anyFilled(['subject','max_price']))
                    <a href="{{ url('/tutors') }}" class="tl-btn-clear">✕ Clear Filters</a>
                @endif

            </form>
        </div>
    </aside>

    {{-- ── Tutors Main ── --}}
    <main>
        <div class="tl-main-header">
            <div class="tl-results-title">Available Tutors</div>
            <div class="tl-results-count">Showing all results</div>
        </div>

        <div id="tutors-container">
            @include('tutors.partials.tutor_cards')
        </div>
    </main>

</div>

<script>
    const subjectInput    = document.getElementById('subjectAjaxInput');
    const suggestionsBox  = document.getElementById('subjectSuggestions');
    const hiddenSubject   = document.getElementById('hiddenSubject');
    const priceRange      = document.getElementById('priceRange');
    const priceValue      = document.getElementById('priceValue');
    const container       = document.getElementById('tutors-container');

    // Price Range
    if (priceRange) {
        priceRange.addEventListener('input', function () {
            priceValue.textContent = this.value;
            debounce(() => fetchTutors());
        });
    }

    // Debounce
    let debounceTimer;
    function debounce(callback, delay = 400) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(callback, delay);
    }

    // Subject Input
    subjectInput.addEventListener('input', function () {
        let query = this.value.trim();
        hiddenSubject.value = query;
        debounce(() => fetchTutors());

        if (query.length >= 2) {
            fetch(`/api/subjects/search?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';
                    if (data.length > 0) {
                        suggestionsBox.style.display = 'block';
                        data.forEach(subject => {
                            let div = document.createElement('div');
                            div.className = 'tl-suggestion-item';
                            div.innerText = subject.name;
                            div.onclick = function () {
                                subjectInput.value = subject.name;
                                hiddenSubject.value = subject.name;
                                suggestionsBox.style.display = 'none';
                                fetchTutors();
                            };
                            suggestionsBox.appendChild(div);
                        });
                    } else {
                        suggestionsBox.style.display = 'none';
                    }
                });
        } else {
            suggestionsBox.style.display = 'none';
        }
    });

    // Fetch Tutors
    function fetchTutors() {
        const form   = document.getElementById('filterForm');
        const params = new URLSearchParams(new FormData(form)).toString();

        container.classList.add('tl-loading');

        fetch(`/tutors?${params}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            container.innerHTML = html;
            container.classList.remove('tl-loading');
        });
    }

    // Click outside → hide suggestions
    document.addEventListener('click', (e) => {
        if (!subjectInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });
</script>
</body>
</html>
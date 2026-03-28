<x-app-layout>
<style>
    html { scroll-behavior: smooth; }

    /* ── THEME TOKENS (match dashboard indigo/purple) ── */
    :root {
        --bg:       #f1f5f9;
        --surface:  #ffffff;
        --primary:  #4f46e5;
        --primary2: #6d28d9;
        --accent:   #818cf8;
        --text:     #0f172a;
        --muted:    #64748b;
        --border:   #e2e8f0;
        --success:  #10b981;
        --info:     #0ea5e9;
        --warn:     #f59e0b;
        --danger:   #ef4444;
        --r:        1rem;
        --r-lg:     1.5rem;
        --r-xl:     2rem;
    }

    /* ── PROFILE HERO CARD ── */
    .hero-card {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 60%, #6d28d9 100%);
        border-radius: var(--r-xl);
        padding: 3rem 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(79, 70, 229, 0.35);
        margin-bottom: 1.5rem;
    }
    .hero-card::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 280px; height: 280px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .hero-card::after {
        content: '';
        position: absolute;
        bottom: -50px; left: -50px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .tutor-avatar {
        width: 90px; height: 90px;
        background: rgba(255,255,255,0.15);
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 1.25rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem; font-weight: 900; color: white;
        font-family: 'Lexend', sans-serif;
        flex-shrink: 0;
        backdrop-filter: blur(10px);
    }

    .hero-name {
        font-size: 1.9rem; font-weight: 800; color: #fff;
        line-height: 1.1; letter-spacing: -0.03em;
        font-family: 'Lexend', sans-serif;
    }
    .hero-title {
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem; font-weight: 500;
        margin-top: 0.2rem;
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        padding: 0.3rem 0.9rem;
        border-radius: 999px;
        font-size: 0.78rem; font-weight: 700;
        letter-spacing: 0.03em;
        backdrop-filter: blur(6px);
    }

    .stat-pill {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 999px;
        padding: 0.5rem 1.2rem;
        display: flex; align-items: center; gap: 0.5rem;
        color: rgba(255,255,255,0.9);
        font-size: 0.82rem; font-weight: 600;
        backdrop-filter: blur(6px);
    }
    .stat-pill svg { opacity: 0.7; }

    /* ── SECTION CARD ── */
    .section-card {
        background: var(--surface);
        border-radius: var(--r-xl);
        border: 1px solid var(--border);
        padding: 2rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }
    .section-title {
        font-size: 1rem; font-weight: 800; color: var(--text);
        letter-spacing: -0.01em;
        display: flex; align-items: center; gap: 0.65rem;
        margin-bottom: 1.25rem;
        font-family: 'Lexend', sans-serif;
    }
    .section-dot {
        width: 8px; height: 28px;
        background: linear-gradient(180deg, #4f46e5, #7c3aed);
        border-radius: 999px;
        flex-shrink: 0;
    }

    /* ── ACTION BUTTONS ── */
    .action-btn {
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        padding: 0.85rem 1rem;
        border-radius: 0.875rem;
        font-size: 0.82rem; font-weight: 700;
        letter-spacing: 0.02em;
        color: white; border: none; cursor: pointer;
        transition: all 0.18s ease;
        text-decoration: none;
    }
    .action-btn:hover { transform: translateY(-2px); filter: brightness(1.08); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
    .action-btn:active { transform: translateY(0); }
    .btn-msg   { background: var(--success); }
    .btn-phone { background: var(--info); }
    .btn-pay   { background: linear-gradient(135deg, #a855f7, #7c3aed); }
    .btn-review{ background: linear-gradient(135deg, #f97316, #ef4444); }
    .btn-store {
        background: var(--text); color: white;
        border-radius: 0.875rem; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 0.6rem;
        padding: 0.9rem 1.25rem; font-weight: 700; font-size: 0.85rem;
        letter-spacing: 0.02em; width: 100%;
        transition: all 0.18s ease;
    }
    .btn-store:hover { background: #4f46e5; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,0.3); }
    .btn-book {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 0.6rem;
        padding: 1rem 1.25rem; font-weight: 800; font-size: 0.85rem;
        letter-spacing: 0.06em; text-transform: uppercase; width: 100%;
        border-radius: 0.875rem;
        box-shadow: 0 10px 30px rgba(79,70,229,0.35);
        transition: all 0.18s ease;
    }
    .btn-book:hover { transform: translateY(-2px); box-shadow: 0 14px 40px rgba(79,70,229,0.45); }

    /* ── INFO ITEMS ── */
    .info-item {
        display: flex; align-items: center; gap: 0.85rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
        font-size: 0.88rem; color: #334155;
        font-weight: 500;
    }
    .info-item:last-child { border-bottom: none; }
    .info-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: #eef2ff; display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .info-icon svg { color: #4f46e5; }
    .rate-badge {
        margin-left: auto;
        font-size: 1.5rem; font-weight: 900; color: #4f46e5;
        font-family: 'Lexend', sans-serif;
    }

    /* ── SKILL TAGS ── */
    .skill-tag {
        display: inline-flex; align-items: center;
        padding: 0.4rem 1rem;
        background: #eef2ff; color: #4338ca;
        border: 1px solid #c7d2fe;
        border-radius: 999px;
        font-size: 0.8rem; font-weight: 700;
        transition: all 0.18s;
        cursor: default;
    }
    .skill-tag:hover { background: #4f46e5; color: white; border-color: #4f46e5; }

    /* ── REVIEW CARD ── */
    .review-card {
        display: flex; gap: 1rem;
        padding: 1.25rem;
        background: #f8faff;
        border: 1px solid #e8edff;
        border-radius: 1rem;
        transition: all 0.15s;
    }
    .review-card:hover { border-color: #c7d2fe; background: #f0f4ff; }
    .reviewer-avatar {
        width: 42px; height: 42px; border-radius: 10px;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1rem; color: #4f46e5;
        flex-shrink: 0; font-family: 'Lexend', sans-serif;
    }
    .stars { color: #fbbf24; font-size: 1rem; letter-spacing: 1px; }

    /* ── BOOKING MODAL ── */
    .modal-overlay {
        position: fixed; inset: 0; z-index: 100;
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        padding: 1rem;
    }
    .modal-box {
        background: #fff;
        border-radius: 1.75rem;
        padding: 2.25rem 2rem;
        max-width: 480px; width: 100%;
        box-shadow: 0 40px 100px rgba(0,0,0,0.25);
        border: 1px solid rgba(255,255,255,0.5);
        max-height: 90vh; overflow-y: auto;
    }
    .modal-input {
        width: 100%; padding: 0.85rem 1rem;
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        border-radius: 0.875rem; color: #0f172a; font-size: 0.9rem; font-weight: 500;
        outline: none; transition: border-color 0.15s;
        font-family: inherit;
    }
    .modal-input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.12); }
    .modal-label {
        display: block; font-size: 0.72rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.08em;
        color: #94a3b8; margin-bottom: 0.45rem; margin-left: 0.25rem;
    }

    /* ── REVIEW MODAL ── */
    .review-modal {
        position: fixed; inset: 0; z-index: 200;
        background: rgba(15,23,42,0.75);
        backdrop-filter: blur(8px);
        display: none; align-items: center; justify-content: center;
        padding: 1rem;
    }
    .review-modal.open { display: flex; }
    .review-modal-box {
        background: #fff;
        border-radius: 1.75rem;
        max-width: 600px; width: 100%;
        max-height: 90vh; display: flex; flex-direction: column;
        box-shadow: 0 40px 100px rgba(0,0,0,0.25);
        overflow: hidden;
    }
    .review-modal-hdr {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        display: flex; align-items: center; justify-content: space-between;
    }
    .review-modal-hdr h3 { color: white; font-weight: 800; font-size: 1.1rem; font-family: 'Lexend', sans-serif; }
    .close-btn {
        width: 34px; height: 34px; border-radius: 50%;
        background: rgba(255,255,255,0.2); border: none; color: white;
        font-size: 1.3rem; cursor: pointer; display: flex; align-items: center; justify-content: center;
        transition: background 0.15s;
    }
    .close-btn:hover { background: rgba(255,255,255,0.35); }

    /* ── STAR RATING ── */
    .star-row { display: flex; gap: 0.5rem; }
    .star {
        font-size: 2.2rem; cursor: pointer; color: #e2e8f0;
        transition: color 0.12s, transform 0.12s;
        line-height: 1;
    }
    .star:hover, .star.active { color: #fbbf24; transform: scale(1.2); }

    /* ── SUBMIT BTN ── */
    .submit-btn {
        background: linear-gradient(135deg, #f97316, #ef4444);
        color: white; font-weight: 800; padding: 0.95rem;
        border-radius: 0.875rem; border: none; cursor: pointer;
        width: 100%; font-size: 0.9rem; letter-spacing: 0.04em;
        box-shadow: 0 8px 24px rgba(239,68,68,0.3);
        transition: all 0.18s;
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(239,68,68,0.4); }
    .tutor-avatar {
        width: 120px;          /* Size thora bara kiya hai */
        height: 120px;
        border-radius: 24px;   /* Squircle look (iPhone icons jesa) */
        background: #f8fafc;
        border: 4px solid rgba(255, 255, 255, 0.2); /* Soft glass border */
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2); /* Deep shadow */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutor-avatar:hover {
        transform: scale(1.05); /* Hover effect */
    }

    .tutor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Image ko stretch nahi hone dega */
    }

    .avatar-placeholder {
        font-size: 2.5rem;
        font-weight: 800;
        color: #4f46e5;
    }

    @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700;800;900&display=swap');
</style>

<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;700;800;900&display=swap" rel="stylesheet">

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8" style="background:#f1f5f9; font-family:'Lexend',sans-serif;">
<div class="max-w-6xl mx-auto">

    {{-- ══ HERO BANNER ══ --}}
    <div class="hero-card">
        <div style="position:relative;z-index:1;">
            <div style="display:flex;align-items:flex-start;gap:1.5rem;flex-wrap:wrap;">
                <div class="tutor-avatar">
    {{-- Check karein ke image tutor table mein hai ya uske profile relationship mein --}}
    @if($tutor->profile_image) 
        <img src="{{ asset('storage/' . $tutor->profile_image) }}" style="width:100%; height:100%; object-fit:cover;">
    @elseif(isset($tutor->tutorProfile) && $tutor->tutorProfile->profile_image)
        <img src="{{ asset('storage/' . $tutor->tutorProfile->profile_image) }}" style="width:100%; height:100%; object-fit:cover;">
    @else
        {{ strtoupper(substr($tutor->name, 0, 1)) }}
    @endif
</div>
                <div style="flex:1;min-width:200px;">
                    <p class="hero-title">Tutor Profile</p>
                    <h1 class="hero-name">{{ $tutor->name }}</h1>
                    <p class="hero-title" style="margin-top:0.3rem;">
                        {{ $tutor->tutorProfile->title ?? 'Professional Instructor' }}
                    </p>
                    <div style="display:flex;flex-wrap:wrap;gap:0.6rem;margin-top:1rem;">
                        <a href="#all-reviews" class="hero-badge">
                            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            {{ $tutor->reviews->count() }} Reviews
                        </a>
                        <span class="hero-badge">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2"/></svg>
                            {{ $tutor->tutorProfile->experience ?? 0 }} yrs exp
                        </span>
                        <span class="hero-badge">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/></svg>
                            Lahore, Pakistan
                        </span>
                    </div>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <p style="color:rgba(255,255,255,0.6);font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;">Hourly Rate</p>
                    <p style="color:#fff;font-size:2.2rem;font-weight:900;line-height:1;">${{ $tutor->tutorProfile->hourly_rate ?? 0 }}</p>
                    <p style="color:rgba(255,255,255,0.5);font-size:0.75rem;">per hour</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MAIN GRID ══ --}}
    <div x-data="{ openStore: false }" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Introduction --}}
            <div class="section-card">
                <h3 class="section-title"><span class="section-dot"></span> Introduction</h3>
                <p style="color:#475569;line-height:1.8;font-size:0.93rem;font-weight:400;">
                    {!! nl2br(e($tutor->tutorProfile->bio ?? 'No biography provided.')) !!}
                </p>
            </div>

            {{-- Expertise --}}
            <div class="section-card">
                <h3 class="section-title"><span class="section-dot"></span> Expertise & Subjects</h3>
                <div style="display:flex;flex-wrap:wrap;gap:0.6rem;">
                    @php
                        $skills = $tutor->tutorProfile->expertise
                            ? explode(',', $tutor->tutorProfile->expertise)
                            : [];
                    @endphp
                    @forelse($skills as $skill)
                        @if(trim($skill))
                            <span class="skill-tag">{{ trim($skill) }}</span>
                        @endif
                    @empty
                        <p style="color:#94a3b8;font-size:0.85rem;font-style:italic;">General subjects and mentoring.</p>
                    @endforelse
                </div>
            </div>

            {{-- All Reviews --}}
            <div id="all-reviews" class="section-card scroll-mt-24">
                <h3 class="section-title" style="margin-bottom:1.5rem;"><span class="section-dot"></span> Student Reviews</h3>
                <div style="display:flex;flex-direction:column;gap:0.875rem;">
                    @forelse($tutor->reviews as $review)
                        <div class="review-card">
                            <div class="reviewer-avatar">{{ strtoupper(substr($review->student->name ?? 'S', 0, 1)) }}</div>
                            <div style="flex:1;">
                                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:0.5rem;flex-wrap:wrap;">
                                    <div>
                                        <p style="font-weight:700;color:#0f172a;font-size:0.9rem;">{{ $review->student->name }}</p>
                                        <p style="font-size:0.75rem;color:#94a3b8;margin-top:0.1rem;">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p style="margin-top:0.6rem;color:#475569;font-size:0.88rem;font-style:italic;line-height:1.6;">
                                        "{{ $review->comment }}"
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center;padding:3rem 0;color:#94a3b8;font-style:italic;">No reviews yet.</div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-4">

            {{-- Action Buttons Grid --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;">
                <a href="{{ url('/conversation/' . $tutor->id . '/messages') }}" class="action-btn btn-msg">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2"/></svg>
                    Message
                </a>
                <button class="action-btn btn-phone">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2"/></svg>
                    Phone
                </button>
                <button class="action-btn btn-pay">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2"/></svg>
                    Pay
                </button>
                <button onclick="openReviewModal()" class="action-btn btn-review">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" stroke-width="2"/></svg>
                    Review
                </button>
            </div>

            {{-- Digital Store --}}
            <button @click="openStore = true" class="btn-store">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2"/></svg>
                Digital Store
            </button>

            {{-- Book Session --}}
            <div x-data="{ showBookingModal: false }">
                <button @click="showBookingModal = true" class="btn-book">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                    Book a Session
                </button>

                {{-- Booking Modal --}}
                <div x-show="showBookingModal" x-cloak class="modal-overlay" style="display:none;">
                    <div @click.outside="showBookingModal = false">
                        <div class="modal-box">
                            <div style="text-align:center;margin-bottom:1.75rem;">
                                <div style="width:52px;height:52px;background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                                    <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                                </div>
                                <h3 style="font-size:1.25rem;font-weight:800;color:#0f172a;font-family:'Lexend',sans-serif;">Request a Booking</h3>
                                <p style="color:#94a3b8;font-size:0.83rem;margin-top:0.25rem;">with {{ $tutor->name }}</p>
                            </div>
                            <form action="{{ route('bookings.store') }}" method="POST" style="display:flex;flex-direction:column;gap:1.1rem;">
                                @csrf
                                <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                <div>
                                    <label class="modal-label">Subject</label>
                                    <input type="text" name="subject" placeholder="e.g. Python for Beginners" required class="modal-input">
                                </div>
                                <div>
                                    <label class="modal-label">Date & Time</label>
                                    <input type="datetime-local" name="booking_time" required class="modal-input">
                                </div>
                                <div>
                                    <label class="modal-label">Message (Optional)</label>
                                    <textarea name="message" placeholder="Any specific topics you want to cover?" class="modal-input" style="height:90px;resize:none;"></textarea>
                                </div>
                                <div style="display:flex;gap:0.75rem;margin-top:0.5rem;">
                                    <button type="button" @click="showBookingModal = false"
                                        style="flex:1;padding:0.9rem;background:#f1f5f9;color:#64748b;border:none;border-radius:0.875rem;font-weight:700;font-size:0.83rem;cursor:pointer;letter-spacing:0.04em;text-transform:uppercase;">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        style="flex:2;padding:0.9rem;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:white;border:none;border-radius:0.875rem;font-weight:800;font-size:0.83rem;cursor:pointer;letter-spacing:0.06em;text-transform:uppercase;box-shadow:0 8px 24px rgba(79,70,229,0.35);">
                                        Send Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="section-card" style="padding:1.25rem 1.5rem;">
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="#4f46e5" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/></svg>
                    </div>
                    Lahore, Pakistan
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="#4f46e5" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                    </div>
                    Joined {{ $tutor->created_at->format('M d, Y') }}
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="#4f46e5" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2"/></svg>
                    </div>
                    {{ $tutor->tutorProfile->experience ?? 0 }} years experience
                </div>
                <div class="info-item" style="border-bottom:none;">
                    <div class="info-icon">
                        <svg width="18" height="18" fill="none" stroke="#4f46e5" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                    </div>
                    Hourly Rate
                    <span class="rate-badge">${{ $tutor->tutorProfile->hourly_rate ?? 0 }}</span>
                </div>
            </div>

        </div>{{-- /sidebar --}}

        {{-- Digital Store Modal --}}
        <div x-show="openStore" x-cloak class="modal-overlay" style="display:none;" x-transition.opacity>
            <div class="modal-box" @click.outside="openStore = false">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                    <h3 style="font-size:1.15rem;font-weight:800;color:#0f172a;font-family:'Lexend',sans-serif;">Digital Store</h3>
                    <button @click="openStore = false" class="close-btn" style="background:#f1f5f9;color:#64748b;">×</button>
                </div>
                <p style="color:#94a3b8;text-align:center;padding:3rem 0;font-style:italic;">No items in store yet.</p>
            </div>
        </div>

    </div>{{-- /grid --}}
</div>
</div>

{{-- ══ REVIEW MODAL ══ --}}
<div id="reviewModal" class="review-modal">
    <div class="review-modal-box">
        <div class="review-modal-hdr">
            <h3>Reviews · {{ $tutor->name }}</h3>
            <button onclick="closeReviewModal()" class="close-btn">×</button>
        </div>

        <div style="flex:1;padding:1.5rem 2rem;overflow-y:auto;display:flex;flex-direction:column;gap:1rem;">
            @forelse($tutor->reviews as $review)
                <div class="review-card">
                    <div class="reviewer-avatar">{{ strtoupper(substr($review->student->name ?? 'S', 0, 1)) }}</div>
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:0.4rem;">
                            <div>
                                <p style="font-weight:700;color:#0f172a;font-size:0.9rem;">{{ $review->student->name }}</p>
                                <p style="font-size:0.75rem;color:#94a3b8;">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="stars">
                                @for($i=1;$i<=5;$i++){{ $i<=$review->rating?'★':'☆' }}@endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p style="margin-top:0.6rem;color:#475569;font-size:0.87rem;font-style:italic;">"{{ $review->comment }}"</p>
                        @endif
                    </div>
                </div>
            @empty
                <p style="text-align:center;padding:3rem;color:#94a3b8;font-style:italic;">No reviews yet.</p>
            @endforelse
        </div>

        @auth
            @if(auth()->user()->role === 'student')
                @php $alreadyReviewed = $tutor->reviews->where('student_id', auth()->id())->isNotEmpty(); @endphp
                @if(!$alreadyReviewed)
                <div style="border-top:1px solid #e2e8f0;padding:1.5rem 2rem;background:#f8fafc;">
                    <h4 style="font-weight:800;font-size:0.95rem;color:#0f172a;margin-bottom:1rem;font-family:'Lexend',sans-serif;">Write Your Review</h4>
                    <form action="{{ route('reviews.store', $tutor->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                        <div style="margin-bottom:1rem;">
                            <div class="star-row" id="modal-star-rating">
                                @for($i=1;$i<=5;$i++)
                                    <span class="star" data-value="{{ $i }}">★</span>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="modal-hidden-rating" required>
                        </div>
                        <textarea name="comment" rows="3" class="modal-input" style="height:80px;resize:none;margin-bottom:1rem;" placeholder="Share your honest experience..."></textarea>
                        <button type="submit" class="submit-btn">Submit Review</button>
                    </form>
                </div>
                @endif
            @endif
        @endauth
    </div>
</div>

<script>
    function openReviewModal()  { document.getElementById('reviewModal').classList.add('open'); }
    function closeReviewModal() { document.getElementById('reviewModal').classList.remove('open'); }

    document.addEventListener('DOMContentLoaded', function () {
        const stars  = document.querySelectorAll('#modal-star-rating .star');
        const hidden = document.getElementById('modal-hidden-rating');
        if (!stars.length) return;
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const val = parseInt(this.dataset.value);
                hidden.value = val;
                stars.forEach(s => s.classList.toggle('active', parseInt(s.dataset.value) <= val));
            });
            star.addEventListener('mouseenter', function () {
                const val = parseInt(this.dataset.value);
                stars.forEach(s => { if(parseInt(s.dataset.value) <= val) s.style.color='#fbbf24'; else s.style.color=''; });
            });
            star.addEventListener('mouseleave', function () {
                const sel = hidden.value ? parseInt(hidden.value) : 0;
                stars.forEach(s => { s.style.color = parseInt(s.dataset.value) <= sel ? '#fbbf24' : ''; });
            });
        });
    });
</script>
</x-app-layout>
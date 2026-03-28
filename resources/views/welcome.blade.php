<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorLink | Find Your Perfect Tutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        :root {
            --p: #4f46e5;
            --p2: #7c3aed;
            --grad: linear-gradient(135deg, #4f46e5, #7c3aed);
            --text: #1e1b4b;
            --muted: #6b7280;
            --bg: #f4f6fb;
            --white: #ffffff;
            --border: #e8eaf0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden
        }

        #cv {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.25
        }

        /* ── HEADER ── */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--grad);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            font-size: 18px;
            font-weight: 900;
            color: white;
        }

        .logo-text {
            font-size: 17px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.3px;
        }

        .logo-text span {
            color: var(--p);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none
        }

        .nav-links a {
            font-size: 14px;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 10px;
            transition: all .2s;
        }

        .nav-links a:hover {
            color: var(--p);
            background: #eef2ff
        }

        .btn-nav {
            font-size: 13px;
            font-weight: 700;
            color: white !important;
            background: var(--grad) !important;
            padding: 9px 22px !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all .2s !important;
        }

        .btn-nav:hover {
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45) !important;
            transform: translateY(-1px);
            background: var(--grad) !important;
            color: white !important;
        }

        /* ── HERO ── */
        .hero {
            position: relative;
            z-index: 2;
            background: var(--grad);
            overflow: hidden;
            padding: 6rem 2rem 0;
            min-height: 520px;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: var(--bg);
            clip-path: ellipse(55% 100% at 50% 100%);
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -200px;
            right: -150px;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -100px;
            left: -80px;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 2;
        }

        .hero-left {
            padding-bottom: 6rem;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.9);
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            backdrop-filter: blur(4px);
            animation: fadeUp .6s ease both;
        }

        .hero-eyebrow-dot {
            width: 6px;
            height: 6px;
            background: #34d399;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: 0.6;
                transform: scale(1.3)
            }
        }

        .hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 900;
            line-height: 1.12;
            color: #fff;
            margin-bottom: 1.2rem;
            letter-spacing: -1px;
            animation: fadeUp .7s .1s ease both;
        }

        .hero h1 em {
            font-style: normal;
            background: linear-gradient(135deg, #a5f3fc, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1rem;
            color: rgba(255, 255, 255, .8);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 420px;
            font-weight: 500;
            animation: fadeUp .7s .2s ease both;
        }

        .hero-search {
            display: flex;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .2);
            max-width: 480px;
            animation: fadeUp .7s .3s ease both;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-search input {
            border: none;
            outline: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            color: var(--text);
            padding: 14px 18px;
            flex: 1;
            min-width: 0;
            font-weight: 500;
        }

        .hero-search input::placeholder {
            color: #9ca3af
        }

        .hero-search button {
            background: var(--grad);
            color: #fff;
            border: none;
            padding: 14px 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity .2s;
        }

        .hero-search button:hover {
            opacity: .9
        }

        .hero-stats {
            display: flex;
            gap: 24px;
            margin-top: 24px;
            animation: fadeUp .7s .4s ease both;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-stat-val {
            font-size: 18px;
            font-weight: 900;
            color: #fff;
        }

        .hero-stat-lbl {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 500;
            line-height: 1.3;
        }

        .hero-stat-div {
            width: 1px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Hero Right Mockup */
        .hero-right {
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .hero-mockup {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px 20px 0 0;
            padding: 24px;
            width: 100%;
            max-width: 380px;
            position: relative;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .mockup-bar {
            display: flex;
            gap: 6px;
            margin-bottom: 4px;
        }

        .mockup-bar span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .mockup-bar span:nth-child(1) {
            background: #f87171
        }

        .mockup-bar span:nth-child(2) {
            background: #fbbf24
        }

        .mockup-bar span:nth-child(3) {
            background: #34d399
        }

        .mockup-lines {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mockup-line {
            height: 10px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.2);
        }

        .mockup-line.short {
            width: 55%
        }

        .mockup-line.med {
            width: 80%
        }

        .mockup-avatar {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a78bfa, #60a5fa);
            border: 4px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .2);
        }

        .fbadge {
            position: absolute;
            background: #fff;
            border-radius: 12px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
            box-shadow: 0 4px 20px rgba(0, 0, 0, .15);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fbadge.b1 {
            top: 20px;
            right: 14px;
            animation: fb 3s ease-in-out infinite alternate;
        }

        .fbadge.b2 {
            bottom: 44px;
            left: -10px;
            animation: fb 3s 1.5s ease-in-out infinite alternate;
        }

        .fbadge .dg {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
        }

        .fbadge .dy {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
        }

        @keyframes fb {
            from {
                transform: translateY(0)
            }

            to {
                transform: translateY(-8px)
            }
        }

        /* ── FEATURES ── */
        .features {
            position: relative;
            z-index: 3;
            max-width: 1200px;
            margin: -10px auto 5rem;
            padding: 0 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feat-card {
            background: #fff;
            border-radius: 20px;
            padding: 28px 24px;
            display: flex;
            align-items: flex-start;
            gap: 18px;
            box-shadow: 0 4px 24px rgba(79, 70, 229, 0.07);
            border: 1px solid rgba(79, 70, 229, 0.07);
            transition: transform .2s, box-shadow .2s;
        }

        .feat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.13);
        }

        .feat-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #eef2ff, #ede9fe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .feat-card h3 {
            font-size: 15px;
            font-weight: 800;
            color: var(--p);
            margin-bottom: 6px;
        }

        .feat-card p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── TUTORS ── */
        .section {
            max-width: 1200px;
            margin: 0 auto 5rem;
            padding: 0 2rem;
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .section-head h2 {
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .section-head h2::after {
            content: '';
            display: block;
            margin-top: 8px;
            width: 40px;
            height: 3px;
            background: var(--grad);
            border-radius: 4px;
        }

        .btn-view {
            font-size: 13px;
            font-weight: 700;
            color: var(--p);
            border: 1.5px solid #c7d2fe;
            padding: 8px 18px;
            border-radius: 50px;
            text-decoration: none;
            transition: all .2s;
            background: #eef2ff;
        }

        .btn-view:hover {
            background: var(--p);
            color: #fff;
            border-color: var(--p);
        }

        .tutors-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .tutor-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
            border: 1px solid var(--border);
            transition: transform .2s, box-shadow .2s;
        }

        .tutor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.12);
        }

        .tutor-img {
            width: 100%;
            height: 190px;
            background: linear-gradient(135deg, #eef2ff, #ede9fe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
        }

        .tutor-info {
            padding: 18px 20px;
        }

        .tutor-info h3 {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 4px;
        }

        .tutor-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            color: var(--p);
            background: #eef2ff;
            padding: 3px 10px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        .stars {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stars span {
            color: #f59e0b;
            font-size: 14px;
        }

        .stars .rev {
            font-size: 12px;
            color: var(--muted);
            margin-left: 4px;
            font-weight: 600;
        }

        /* ── HOW IT WORKS ── */
        .how {
            background: #fff;
            padding: 5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .how::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--grad);
        }

        .how-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .section-title span {
            color: var(--p);
        }

        .section-sub {
            text-align: center;
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 3.5rem;
            font-weight: 500;
        }

        .how-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            align-items: center;
            gap: 12px;
        }

        .how-step {
            text-align: center;
            padding: 16px;
        }

        .how-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--grad);
            color: white;
            font-size: 12px;
            font-weight: 900;
            margin-bottom: 16px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .how-icon {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, #eef2ff, #ede9fe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            margin: 0 auto 16px;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12);
        }

        .how-step h3 {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
        }

        .how-step p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.65;
        }

        .how-arr {
            font-size: 28px;
            color: #c7d2fe;
            text-align: center;
            font-weight: 300;
        }

        /* ── CTA ── */
        .cta {
            background: var(--grad);
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -200px;
            right: -100px;
            pointer-events: none;
        }

        .cta::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -150px;
            left: -80px;
            pointer-events: none;
        }

        .cta-eyebrow {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.9);
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 900;
            color: #fff;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        .cta p {
            font-size: 15px;
            color: rgba(255, 255, 255, .75);
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
            font-weight: 500;
        }

        .btn-cta {
            display: inline-block;
            background: #fff;
            color: var(--p);
            font-size: 15px;
            font-weight: 800;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .2);
            transition: transform .2s, box-shadow .2s;
            position: relative;
            z-index: 1;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .28);
        }

        /* ── FOOTER ── */
        footer {
            background: #fff;
            border-top: 1px solid var(--border);
            padding: 24px 2rem;
        }

        .ft {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .ft-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
        }

        .ft-logo-icon {
            width: 28px;
            height: 28px;
            background: var(--grad);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 900;
            color: white;
        }

        .ft-logo span {
            color: var(--p);
        }

        .ft p {
            font-size: 13px;
            color: var(--muted);
            font-weight: 500;
        }

        .ft-links {
            display: flex;
            gap: 16px;
        }

        .ft-links a {
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            transition: color .2s;
        }

        .ft-links a:hover {
            color: var(--p);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .reveal.in {
            opacity: 1;
            transform: none;
        }

        @media(max-width:768px) {
            .hero-inner {
                grid-template-columns: 1fr
            }

            .hero-right {
                display: none
            }

            .features-grid,
            .tutors-grid {
                grid-template-columns: 1fr
            }

            .how-grid {
                grid-template-columns: 1fr
            }

            .how-arr {
                display: none
            }

            .nav-links li:not(:last-child) {
                display: none
            }

            .ft {
                flex-direction: column;
                text-align: center
            }

            .hero-stats {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <canvas id="cv"></canvas>

    {{-- ══ HEADER ══ --}}
    <header>
        <nav>
            <a href="/" class="logo">
                <div class="logo-icon">T</div>
                <span class="logo-text">Tutor<span>Link</span></span>
            </a>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/tutors">Find Tutors</a></li>
                <li><a href="/subjects">Subjects</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-nav">Log In</a></li>
                    @endauth
                @endif
                @if (Route::has('register'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('register') }}" class="btn-nav">Register</a></li>
                    @endauth
                @endif
            </ul>
        </nav>
    </header>

    <main>
        {{-- ══ HERO ══ --}}
        <section class="hero">
            <div class="hero-bg"></div>
            <div class="hero-inner">
                <div class="hero-left">
                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        500+ Expert Tutors Available
                    </div>
                    <h1>Find the Perfect Tutor<br>for <em>Your Learning</em><br>Journey</h1>
                    <p>Connect with expert instructors for personalized one-on-one lessons. Learn at your pace, on your
                        schedule.</p>
                    <form action="/tutors/search" method="GET" class="hero-search">
                        <input type="text" name="query" placeholder="What do you want to learn?">
                        <button type="submit">Search →</button>
                    </form>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div>
                                <div class="hero-stat-val">500+</div>
                                <div class="hero-stat-lbl">Expert<br>Tutors</div>
                            </div>
                        </div>
                        <div class="hero-stat-div"></div>
                        <div class="hero-stat">
                            <div>
                                <div class="hero-stat-val">10k+</div>
                                <div class="hero-stat-lbl">Happy<br>Students</div>
                            </div>
                        </div>
                        <div class="hero-stat-div"></div>
                        <div class="hero-stat">
                            <div>
                                <div class="hero-stat-val">98%</div>
                                <div class="hero-stat-lbl">Satisfaction<br>Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="hero-mockup">
                        <div class="mockup-bar"><span></span><span></span><span></span></div>
                        <div class="mockup-lines">
                            <div class="mockup-line med"></div>
                            <div class="mockup-line short"></div>
                            <div class="mockup-line med"></div>
                            <div class="mockup-line short"></div>
                            <div class="mockup-line med"></div>
                        </div>
                        <div class="mockup-avatar">👩‍💻</div>
                        <div class="fbadge b1"><span class="dg"></span> Live Session</div>
                        <div class="fbadge b2"><span class="dy"></span> 500+ Tutors</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ FEATURES ══ --}}
        <section class="features reveal">
            <div class="features-grid">
                <div class="feat-card">
                    <div class="feat-icon">🎓</div>
                    <div>
                        <h3>Expert Tutors</h3>
                        <p>Learn from qualified and experienced instructors across 100+ subjects.</p>
                    </div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon">📅</div>
                    <div>
                        <h3>Flexible Scheduling</h3>
                        <p>Book lessons that perfectly fit your busy lifestyle and timezone.</p>
                    </div>
                </div>
                <div class="feat-card">
                    <div class="feat-icon">💰</div>
                    <div>
                        <h3>Affordable Rates</h3>
                        <p>High-quality tutoring at prices that work for every budget.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ TOP TUTORS ══ --}}
        <section class="section reveal">
            <div class="section-head flex justify-between items-center mb-10">
                <h2 class="text-3xl font-black text-slate-900">Top Rated Tutors</h2>
                <a href="/tutors" class="text-purple-600 font-semibold hover:underline">
                    View All →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Tutor 1 --}}
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-slate-100">
                    <div class="h-60 overflow-hidden">
                        <img src="https://www.ziprecruiter.com/svc/fotomat/public-ziprecruiter/cms/1143696570InternationalOnlineTutor.jpg"
                            class="w-full h-full object-cover" alt="Tutor">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">Sarah Malik</h3>
                        <p class="text-sm text-slate-500 mt-1">Math & Physics Expert</p>

                        <div class="flex items-center justify-between mt-3">
                        </div>
                    </div>
                </div>

                {{-- Tutor 2 --}}
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-slate-100">
                    <div class="h-60 overflow-hidden">
                        <img src="https://thumbs.dreamstime.com/b/online-communication-happy-freelancer-headset-having-video-call-via-laptop-computer-working-home-sitting-sofa-smiling-man-350241233.jpg"
                            class="w-full h-full object-cover" alt="Tutor">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">James Khan</h3>
                        <p class="text-sm text-slate-500 mt-1">English & Literature</p>

                        <div class="flex items-center justify-between mt-3">
                        </div>
                    </div>
                </div>

                {{-- Tutor 3 --}}
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-slate-100">
                    <div class="h-60 overflow-hidden">
                        <img src="https://thumbs.dreamstime.com/b/learning-remotely-professional-female-tutor-giving-online-language-lesson-living-room-interior-186797240.jpg"
                            class="w-full h-full object-cover" alt="Tutor">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">Aisha Ahmed</h3>
                        <p class="text-sm text-slate-500 mt-1">Chemistry Specialist</p>

                        <div class="flex items-center justify-between mt-3">
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- ══ HOW IT WORKS ══ --}}
        <section class="how reveal" id="how">
            <div class="how-inner">
                <div class="section-title">How <span>TutorLink</span> Works</div>
                <div class="section-sub">Three simple steps to start your learning journey</div>
                <div class="how-grid">
                    <div class="how-step">
                        <div class="how-num">1</div>
                        <div class="how-icon">🔍</div>
                        <h3>Find Your Tutor</h3>
                        <p>Browse verified profiles and choose your ideal tutor by subject, rating, and price.</p>
                    </div>
                    <div class="how-arr">›</div>
                    <div class="how-step">
                        <div class="how-num">2</div>
                        <div class="how-icon">📆</div>
                        <h3>Book a Lesson</h3>
                        <p>Schedule sessions at times that work best for you — morning, evening, or weekend.</p>
                    </div>
                    <div class="how-arr">›</div>
                    <div class="how-step">
                        <div class="how-num">3</div>
                        <div class="how-icon">💻</div>
                        <h3>Start Learning</h3>
                        <p>Begin your journey with expert one-on-one guidance and achieve your goals.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ CTA ══ --}}
        <section class="cta">
            <div class="cta-eyebrow">🚀 Join 10,000+ Students</div>
            <h2>Ready to Boost Your Learning?</h2>
            <p>Join TutorLink today and start achieving your academic goals with expert guidance.</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-cta">Go to Dashboard →</a>
                @else
                    <a href="{{ route('register') }}" class="btn-cta">Get Started Free →</a>
                @endauth
            @endif
        </section>
    </main>

    {{-- ══ FOOTER ══ --}}
    <footer>
        <div class="ft">
            <div class="ft-logo">
                <div class="ft-logo-icon">T</div>
                Tutor<span>Link</span>
            </div>
            <p>&copy; 2026 TutorLink. All rights reserved.</p>
            <div class="ft-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            const cv = document.getElementById('cv'), cx = cv.getContext('2d');
            let W, H, pts = [];
            const N = 50, C = ['#7c3aed', '#6366f1', '#a78bfa', '#4f46e5', '#8b5cf6'];
            const mx = { x: -999, y: -999 };
            function resize() { W = cv.width = innerWidth; H = cv.height = innerHeight; }
            class P {
                constructor() { this.r(true); }
                r(i) { this.x = Math.random() * W; this.y = i ? Math.random() * H : H + 8; this.s = Math.random() * 2 + .4; this.vx = (Math.random() - .5) * .3; this.vy = -(Math.random() * .4 + .1); this.a = Math.random() * .4 + .1; this.da = (Math.random() * .002 + .001) * (Math.random() < .5 ? 1 : -1); this.c = C[Math.floor(Math.random() * C.length)]; }
                u() { this.x += this.vx; this.y += this.vy; this.a += this.da; if (this.a < .08 || this.a > .55) this.da *= -1; const dx = this.x - mx.x, dy = this.y - mx.y, d = Math.hypot(dx, dy); if (d < 80) { const f = (80 - d) / 80; this.x += dx / d * f * 1.5; this.y += dy / d * f * 1.5; } if (this.y < -8) this.r(false); if (this.x < -8) this.x = W + 8; if (this.x > W + 8) this.x = -8; }
                d() { cx.save(); cx.globalAlpha = this.a; cx.fillStyle = this.c; cx.shadowColor = this.c; cx.shadowBlur = this.s * 4; cx.beginPath(); cx.arc(this.x, this.y, this.s, 0, Math.PI * 2); cx.fill(); cx.restore(); }
            }
            function lines() { for (let i = 0; i < pts.length; i++)for (let j = i + 1; j < pts.length; j++) { const d = Math.hypot(pts[i].x - pts[j].x, pts[i].y - pts[j].y); if (d < 100) { cx.save(); cx.globalAlpha = (1 - d / 100) * .06; cx.strokeStyle = '#4f46e5'; cx.lineWidth = .6; cx.beginPath(); cx.moveTo(pts[i].x, pts[i].y); cx.lineTo(pts[j].x, pts[j].y); cx.stroke(); cx.restore(); } } }
            resize(); pts = Array.from({ length: N }, () => new P());
            addEventListener('resize', resize);
            addEventListener('mousemove', e => { mx.x = e.clientX; mx.y = e.clientY; });
            addEventListener('mouseleave', () => { mx.x = -999; mx.y = -999; });
            (function loop() { cx.clearRect(0, 0, W, H); lines(); pts.forEach(p => { p.u(); p.d(); }); requestAnimationFrame(loop); })();
        })();
        const obs = new IntersectionObserver(es => es.forEach(e => e.isIntersecting && e.target.classList.add('in')), { threshold: .15 });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TutorLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Fraunces:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --p: #4f46e5; --p2: #7c3aed; --grad: linear-gradient(135deg, #4f46e5, #7c3aed);
            --p-light: #eef2ff; --p-mid: #c7d2fe; --p-soft: #ede9fe;
            --text: #1e1b4b; --muted: #6b7280; --border: #e8eaf0; --bg: #f0eeff; --white: #ffffff;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg);
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px 16px;
        }
        .shell {
            width: 100%; max-width: 850px; background: var(--white); border-radius: 28px;
            box-shadow: 0 32px 80px rgba(79,70,229,0.18); display: grid; grid-template-columns: 1fr 380px;
            overflow: hidden; min-height: 580px;
        }

        .form-side { padding: 45px; display: flex; flex-direction: column; justify-content: center; background: white; }
        
        .brand { display: flex; align-items: center; gap: 9px; margin-bottom: 35px; text-decoration: none; }
        .brand-box { width: 32px; height: 32px; background: var(--grad); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900; box-shadow: 0 4px 12px rgba(79,70,229,0.35); }
        .brand-name { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-name span { color: var(--p); }

        .form-heading { font-family: 'Fraunces', serif; font-size: 28px; color: var(--text); margin-bottom: 6px; }
        .form-heading em { font-style: italic; background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .form-sub { font-size: 14px; color: var(--muted); margin-bottom: 30px; }

        .field { margin-bottom: 18px; }
        .f-label { display: block; font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 6px; }
        .f-input { width: 100%; background: #f8f7ff; border: 1.5px solid #e8e6f9; border-radius: 11px; padding: 12px 15px; font-size: 14px; color: var(--text); outline: none; transition: 0.2s; }
        .f-input:focus { border-color: var(--p); background: white; box-shadow: 0 0 0 4px rgba(79,70,229,0.05); }

        .options-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; }
        .remember-me { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--muted); cursor: pointer; }
        .remember-me input { accent-color: var(--p); width: 15px; height: 15px; }
        .forgot-link { font-size: 12px; color: var(--p); text-decoration: none; font-weight: 600; }

        .submit-btn { width: 100%; background: var(--grad); color: white; border: none; padding: 14px; border-radius: 11px; font-weight: 800; cursor: pointer; box-shadow: 0 6px 20px rgba(79,70,229,0.3); transition: 0.3s; }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }

        /* VISUAL SIDE */
        .visual-side { position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: flex-end; }
        .vis-bg { 
            position: absolute; inset: 0; 
            background: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
        }
        .vis-bg::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(79, 70, 229, 0.1) 0%, rgba(30, 27, 75, 0.9) 100%);
        }

        .vis-content { position: relative; z-index: 10; padding: 35px; color: white; }
        .vis-quote { font-family: 'Fraunces', serif; font-size: 20px; font-weight: 300; line-height: 1.4; margin-bottom: 15px; }
        .vis-author { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--p-mid); }

        @media(max-width: 800px) { 
            .shell { grid-template-columns: 1fr; max-width: 420px; } 
            .visual-side { display: none; } 
        }
    </style>
</head>
<body>

<div class="shell">
    <!-- FORM SIDE -->
    <div class="form-side">
        <a href="/" class="brand">
            <div class="brand-box">T</div>
            <span class="brand-name">Tutor<span>Link</span></span>
        </a>

        <h1 class="form-heading">Welcome <em>back</em></h1>
        <p class="form-sub">Enter your credentials to access your account.</p>

        <!-- Session Status -->
        @if (session('status'))
            <div style="background: var(--p-light); color: var(--p); padding: 10px; border-radius: 8px; font-size: 12px; margin-bottom: 20px; font-weight: 600;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="field">
                <label class="f-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="f-input" placeholder="name@example.com" required autofocus>
                @error('email')<div style="color:#ef4444; font-size:11px; margin-top:4px; font-weight:600;">{{ $message }}</div>@enderror
            </div>

            <!-- Password -->
            <div class="field">
                <label class="f-label">Password</label>
                <input type="password" name="password" class="f-input" placeholder="••••••••••••" required>
                @error('password')<div style="color:#ef4444; font-size:11px; margin-top:4px; font-weight:600;">{{ $message }}</div>@enderror
            </div>

            <div class="options-row">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="submit-btn">Sign In</button>

            <div style="text-align: center; margin-top: 25px; font-size: 12px; color: #a09dc0;">
                Don't have an account? <a href="{{ route('register') }}" style="color: var(--p); font-weight: 700; text-decoration: none;">Create one</a>
            </div>
        </form>
    </div>

    <!-- VISUAL SIDE (Same as Register) -->
    <div class="visual-side">
        <div class="vis-bg"></div>
        <div class="vis-content">
            <div class="vis-quote">"Education is the most powerful weapon which you can use to change the world."</div>
            <div class="vis-author">— Nelson Mandela</div>
        </div>
    </div>
</div>

</body>
</html>
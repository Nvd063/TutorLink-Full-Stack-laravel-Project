<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | TutorLink</title>
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
            width: 100%; max-width: 900px; background: var(--white); border-radius: 28px;
            box-shadow: 0 32px 80px rgba(79,70,229,0.18); display: grid; grid-template-columns: 420px 1fr;
            overflow: hidden; min-height: 620px; transition: all 0.55s cubic-bezier(0.4,0,0.2,1);
        }
        .shell.tutor-mode { max-width: 1160px; grid-template-columns: 420px 320px 1fr; }

        .form-side { padding: 40px; display: flex; flex-direction: column; overflow-y: auto; max-height: 92vh; background: white; position: relative; z-index: 2; }
        .form-side::-webkit-scrollbar { width: 3px; }
        .form-side::-webkit-scrollbar-thumb { background: var(--p-mid); border-radius: 4px; }

        .brand { display: flex; align-items: center; gap: 9px; margin-bottom: 30px; }
        .brand-box { width: 32px; height: 32px; background: var(--grad); border-radius: 9px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900; box-shadow: 0 4px 12px rgba(79,70,229,0.35); }
        .brand-name { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-name span { color: var(--p); }

        .form-heading { font-family: 'Fraunces', serif; font-size: 26px; color: var(--text); margin-bottom: 4px; }
        .form-heading em { font-style: italic; background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .form-sub { font-size: 13px; color: var(--muted); margin-bottom: 20px; }

        .role-tabs { display: grid; grid-template-columns: 1fr 1fr; background: var(--p-light); border-radius: 11px; padding: 4px; margin-bottom: 20px; }
        .role-tab-inner { display: flex; align-items: center; justify-content: center; gap: 7px; padding: 9px; border-radius: 8px; font-size: 13px; font-weight: 700; color: var(--muted); cursor: pointer; transition: 0.25s; }
        input[type="radio"]:checked + .role-tab-inner { background: white; color: var(--p); box-shadow: 0 2px 10px rgba(79,70,229,0.1); }

        .field { margin-bottom: 12px; }
        .f-label { display: block; font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 5px; }
        .f-input { width: 100%; background: #f8f7ff; border: 1.5px solid #e8e6f9; border-radius: 11px; padding: 10px 14px; font-size: 13px; color: var(--text); outline: none; transition: 0.2s; }
        .f-input:focus { border-color: var(--p); background: white; }

        .submit-btn { width: 100%; background: var(--grad); color: white; border: none; padding: 13px; border-radius: 11px; font-weight: 800; cursor: pointer; margin-top: 10px; box-shadow: 0 6px 20px rgba(79,70,229,0.3); }

        /* TUTOR PANEL COMPACT */
        .tutor-panel { background: #f8f7ff; border-left: 1px solid #eae8f8; padding: 30px 20px; overflow-y: auto; max-height: 92vh; display: none; opacity: 0; transform: translateX(20px); transition: 0.4s; }
        .tutor-panel.visible { display: block; opacity: 1; transform: translateX(0); }
        .t-section { font-size: 9px; font-weight: 800; color: #a09dc0; text-transform: uppercase; display: flex; align-items: center; gap: 8px; margin: 15px 0 10px; }
        .t-section::after { content: ''; flex: 1; height: 1px; background: #eae8f8; }
        .t-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        /* Document Zones Compact */
        .file-zone { border: 1.5px dashed #c7d2fe; border-radius: 10px; padding: 8px 12px; background: white; margin-bottom: 8px; position: relative; }
        .fz-top { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
        .fz-icon { width: 24px; height: 24px; background: var(--p-light); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 11px; border: 1px solid var(--p-mid); }
        .fz-title { font-size: 11px; font-weight: 800; color: var(--text); }
        .fz-sub { font-size: 9px; color: var(--muted); }
        .f-file { font-size: 10px; color: var(--muted); width: 100%; cursor: pointer; }

        /* VISUAL SIDE - IMPROVED */
        .visual-side { position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: flex-end; }
        
        /* New Image Background with Overlay */
        .vis-bg { 
            position: absolute; 
            inset: 0; 
            background: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
            transition: transform 0.8s ease;
        }
        
        /* Dark Gradient Overlay for readability */
        .vis-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(79, 70, 229, 0.2) 0%, rgba(30, 27, 75, 0.85) 100%);
        }

        .vis-content { position: relative; z-index: 10; padding: 30px; width: 100%; }
        
        /* Glassmorphism effects */
        .vis-cal { 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(8px); 
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 18px; 
            padding: 18px; 
            margin-bottom: 15px; 
        }
        
        .vis-cal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 4px; }
        .vcd { width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: rgba(255,255,255,0.8); font-weight: 600; }
        .vcd.active { background: var(--grad); border-radius: 8px; color: white; box-shadow: 0 8px 15px rgba(0,0,0,0.3); }
        
        .vis-stats { display: flex; gap: 12px; }
        .vis-stat { 
            background: rgba(255, 255, 255, 0.12); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px; 
            padding: 12px; 
            flex: 1; 
            text-align: center; 
            color: white; 
            transition: 0.3s;
        }
        .vis-stat:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-3px); }
        .vs-val { font-size: 16px; font-weight: 900; display: block; }
        .vs-lbl { font-size: 9px; opacity: 0.8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

        @media(max-width: 860px) { .shell { grid-template-columns: 1fr !important; max-width: 440px !important; } .visual-side, .tutor-panel { display: none !important; } }
    </style>
</head>
<body>

<div class="shell" id="mainShell">
    <!-- START FORM -->
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" style="display: contents;">
        @csrf
        <input type="hidden" name="role" id="roleInput" value="student">

        <div class="form-side">
            <div class="brand">
                <div class="brand-box">T</div>
                <span class="brand-name">Tutor<span>Link</span></span>
            </div>
            
            <h1 class="form-heading">Create an <em>account</em></h1>
            <p class="form-sub">Sign up and get 30 days free trial.</p>

            <div class="role-tabs">
                <label class="role-tab" style="position: relative;">
                    <input type="radio" name="role_tab" value="student" checked onchange="switchRole('student')" style="position: absolute; opacity: 0;">
                    <div class="role-tab-inner">🎓 Student</div>
                </label>
                <label class="role-tab" style="position: relative;">
                    <input type="radio" name="role_tab" value="tutor" onchange="switchRole('tutor')" style="position: absolute; opacity: 0;">
                    <div class="role-tab-inner">📚 Tutor</div>
                </label>
            </div>

            <div class="field">
                <label class="f-label">Fullname</label>
                <input type="text" name="name" value="{{ old('name') }}" class="f-input" placeholder="Amélie Laurent" required autofocus>
                @error('name')<div class="f-error" style="color:red; font-size:10px;">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label class="f-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="f-input" placeholder="amelielaurent@gmail.com" required>
                @error('email')<div class="f-error" style="color:red; font-size:10px;">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label class="f-label">Password</label>
                <input type="password" name="password" class="f-input" placeholder="••••••••••••" required>
            </div>
            <div class="field">
                <label class="f-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="f-input" placeholder="••••••••••••" required>
            </div>

            <button type="submit" class="submit-btn">Create Account</button>
            
            <div style="text-align: center; margin-top: 15px; font-size: 11px; color: #a09dc0;">
                Already have an account? <a href="{{ route('login') }}" style="color: var(--p); font-weight: 700; text-decoration: none;">Sign in</a>
            </div>
        </div>

        <!-- TUTOR EXTRA PANEL -->
        <div class="tutor-panel" id="tutorPanel">
            <div class="t-section">Profile Info</div>
            <div class="t-row">
                <div class="t-field">
                    <label class="f-label">Title</label>
                    <input type="text" name="title" class="f-input" placeholder="Math Expert">
                </div>
                <div class="t-field">
                    <label class="f-label">Location</label>
                    <input type="text" name="location" class="f-input" placeholder="Lahore, PK">
                </div>
            </div>
            <div class="field">
                <label class="f-label">Expertise</label>
                <input type="text" name="expertise" class="f-input" placeholder="Laravel, React, UI Design">
            </div>
            <div class="t-row">
                <div class="t-field">
                    <label class="f-label">Experience</label>
                    <input type="number" name="experience" class="f-input" placeholder="5">
                </div>
                <div class="t-field">
                    <label class="f-label">Hourly Rate ($)</label>
                    <input type="number" name="hourly_rate" class="f-input" placeholder="$">
                </div>
            </div>
            <div class="field">
                <label class="f-label">Bio</label>
                <textarea name="bio" rows="2" class="f-input" placeholder="Briefly about you..."></textarea>
            </div>

            <div class="t-section">Verification Documents</div>
            <div class="file-zone">
                <div class="fz-top">
                    <div class="fz-icon">🎓</div>
                    <div><div class="fz-title">Degree Certificate</div><div class="fz-sub">PDF/JPG</div></div>
                </div>
                <input type="file" name="degree_certificate" class="f-file">
            </div>
            <div class="file-zone">
                <div class="fz-top">
                    <div class="fz-icon">📄</div>
                    <div><div class="fz-title">CV / Resume</div><div class="fz-sub">PDF only</div></div>
                </div>
                <input type="file" name="cv_resume" class="f-file">
            </div>
            <div class="file-zone">
                <div class="fz-top">
                    <div class="fz-icon">🖼️</div>
                    <div><div class="fz-title">Profile Picture</div><div class="fz-sub">JPG/PNG</div></div>
                </div>
                <input type="file" name="profile_image" class="f-file">
            </div>
        </div>
    </form>

    <!-- VISUAL SIDE (Always Right) -->
    <div class="visual-side">
        <div class="vis-bg" id="visBg"></div>
        <div class="vis-content">
            <div class="vis-cal">
                <div class="vis-cal-grid">
                    <div class="vcd">22</div><div class="vcd">23</div><div class="vcd">24</div>
                    <div class="vcd">25</div><div class="vcd">26</div><div class="vcd active">27</div><div class="vcd">28</div>
                </div>
            </div>
            <div class="vis-stats">
                <div class="vis-stat">
                    <span class="vs-val">500+</span>
                    <span class="vs-lbl">Expert Tutors</span>
                </div>
                <div class="vis-stat">
                    <span class="vs-val">10k+</span>
                    <span class="vs-lbl">Students</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchRole(role) {
        document.getElementById('roleInput').value = role;
        const shell = document.getElementById('mainShell');
        const tutorPanel = document.getElementById('tutorPanel');
        const visBg = document.getElementById('visBg');
        
        if (role === 'tutor') {
            shell.classList.add('tutor-mode');
            tutorPanel.style.display = 'block';
            // Subtle zoom effect on background image when expanding
            visBg.style.transform = 'scale(1.1)';
            setTimeout(() => tutorPanel.classList.add('visible'), 10);
        } else {
            tutorPanel.classList.remove('visible');
            shell.classList.remove('tutor-mode');
            visBg.style.transform = 'scale(1)';
            setTimeout(() => tutorPanel.style.display = 'none', 400);
        }
    }
</script>
</body>
</html>
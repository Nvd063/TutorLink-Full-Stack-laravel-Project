<style>
    .tutor-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f1f5f9;
    }

    .tutor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.1),
                    0 10px 10px -5px rgba(79, 70, 229, 0.04);
        border-color: #e2e8f0;
    }

    .tutor-avatar-wrapper {
        width: 100px;
        height: 100px;
        border-radius: 22px;
        overflow: hidden;
        background: #f8fafc;
        border: 3px solid white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tutor-avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .initials-placeholder {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

@forelse($tutors as $tutor)
<div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all flex items-center justify-between">

    <!-- LEFT SIDE -->
    <div class="flex items-center gap-4">

        <!-- Avatar -->
        <div class="tutor-avatar-wrapper">
            @if($tutor->profile_image)
                <img src="{{ asset('storage/' . $tutor->profile_image) }}">
            @elseif(isset($tutor->tutorProfile) && $tutor->tutorProfile->profile_image)
                <img src="{{ asset('storage/' . $tutor->tutorProfile->profile_image) }}">
            @else
                <span class="initials-placeholder">
                    {{ strtoupper(substr($tutor->name, 0, 1)) }}
                </span>
            @endif
        </div>

        <!-- Info -->
        <div>
            <!-- Name -->
            <h3 class="font-bold text-lg text-slate-900">
                {{ $tutor->name }}
            </h3>

            <!-- Intro -->
            <p class="text-sm text-gray-500 line-clamp-1">
                {{ $tutor->tutorProfile->bio ?? 'No intro available' }}
            </p>

            <!-- Subjects / Fields -->
            <p class="text-xs text-indigo-500 mt-1">
                {{ $tutor->subjects->pluck('name')->join(', ') ?? 'No subjects' }}
            </p>

            <!-- Reviews -->
            <div class="text-xs text-black-500 mt-1">
                ⭐ {{ $tutor->reviews->count() ?? 0 }} Reviews
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="text-right">
        <div class="text-indigo-600 font-bold text-xl">
            ${{ $tutor->tutorProfile->hourly_rate ?? '0' }}
            <span class="text-xs text-gray-400">/hr</span>
        </div>

        <a href="/tutor/profile/{{ $tutor->id }}"
           class="mt-2 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
            View Profile
        </a>
    </div>

</div>
@empty
<div class="text-center py-10 text-gray-400">
    No tutors found.
</div>
@endforelse
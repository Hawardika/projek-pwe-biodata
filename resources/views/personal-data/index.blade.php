<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personal Data - {{ $personalData->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .profile-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: background-color 0.25s ease, box-shadow 0.25s ease, color 0.25s ease;
        }
        .skill-badge {
            display: inline-block;
            background-color: #e9ecef;
            color: #495057;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            margin: 0.25rem;
            font-size: 0.875rem;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 2rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 1rem;
            top: 1.5rem;
            width: 2px;
            height: calc(100% - 1rem);
            background: #dee2e6;
        }
        .timeline-item:last-child::after {
            display: none;
        }

        /* ================= DARK MODE ================= */

        body[data-theme="dark"] {
            background-color: #020617;
            color: #e5e7eb;
        }

        body[data-theme="dark"] .profile-card {
            background-color: #111827;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.6);
        }

        body[data-theme="dark"] .profile-header {
            background: linear-gradient(135deg, #1d4ed8 0%, #4c1d95 100%);
        }

        body[data-theme="dark"] .card,
        body[data-theme="dark"] .card-body,
        body[data-theme="dark"] .profile-card {
            color: #e5e7eb;
        }

        body[data-theme="dark"] h1,
        body[data-theme="dark"] h2,
        body[data-theme="dark"] h3,
        body[data-theme="dark"] h4,
        body[data-theme="dark"] h5 {
            color: #e5e7eb;
        }

        body[data-theme="dark"] strong {
            color: #e5e7eb;
        }

        body[data-theme="dark"] .text-muted {
            color: #9ca3af !important;
        }

        body[data-theme="dark"] .skill-badge {
            background-color: #1f2937;
            color: #e5e7eb;
        }

        body[data-theme="dark"] .section-title::after {
            background: linear-gradient(135deg, #60a5fa 0%, #a855f7 100%);
        }

        body[data-theme="dark"] .timeline-item::before {
            background: linear-gradient(135deg, #60a5fa 0%, #a855f7 100%);
        }

        body[data-theme="dark"] .timeline-item::after {
            background: #374151;
        }

        body[data-theme="dark"] .card {
            background-color: #111827;
            border-color: #1f2937;
        }

        body[data-theme="dark"] .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        body[data-theme="dark"] .btn-outline-secondary {
            border-color: #9ca3af;
            color: #e5e7eb;
        }

        body[data-theme="dark"] .btn-outline-secondary:hover {
            background-color: #4b5563;
        }

        body[data-theme="dark"] a {
            color: #93c5fd;
        }

        body[data-theme="dark"] a:hover {
            color: #bfdbfe;
        }

        body[data-theme="dark"] .alert-success {
            background-color: #14532d;
            border-color: #166534;
            color: #bbf7d0;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-end mb-3 gap-2">
                <button id="theme-toggle" type="button" class="btn btn-outline-secondary">
                    <i class="fas fa-moon me-1"></i>
                    <span id="theme-toggle-text">Dark mode</span>
                </button>

                <a href="{{ route('personal-data.edit', $personalData) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </a>
            </div>

            <div class="card profile-card">
                <div class="profile-header p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            @if($personalData->photo)
                                <img src="{{ asset('storage/'.$personalData->photo) }}"
                                     alt="Profile photo"
                                     class="rounded-circle img-fluid"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                     style="width: 100px; height: 100px;">
                                    <span class="display-4 text-white fw-bold">
                                        {{ $personalData->initials }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <h1 class="mb-1">{{ $personalData->name }}</h1>
                            <h4 class="mb-2 opacity-75">{{ $personalData->title }}</h4>
                            <p class="mb-0">{{ $personalData->summary }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Contact --}}
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="section-title">Contact Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <strong>Email:</strong> {{ $personalData->email }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Phone:</strong> {{ $personalData->phone }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Date of Birth:</strong>
                                            {{ optional($personalData->birth_date)->format('d F Y') }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <strong>Address:</strong> {{ $personalData->address }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Nationality:</strong> {{ $personalData->nationality }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>LinkedIn:</strong> {{ $personalData->linkedin }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>GitHub:</strong> {{ $personalData->github }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Skills --}}
                    @php
                        $skills = $personalData->skills_array ?? [];
                    @endphp

                    @if(!empty($skills))
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h3 class="section-title">Skills & Expertise</h3>
                                <div>
                                    @foreach($skills as $skill)
                                        <span class="skill-badge">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Experiences --}}
                    @php
                        $experiences = $personalData->experiences ?? collect();
                    @endphp

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="section-title">Work Experience</h3>

                            @if($experiences->isNotEmpty())
                                @foreach($experiences as $exp)
                                    <div class="timeline-item">
                                        <div>
                                            <h5 class="mb-0">{{ $exp->title }}</h5>
                                            <p class="text-muted mb-1">{{ $exp->company }}</p>
                                            @if($exp->period || $exp->location)
                                                <p class="text-primary mb-2">
                                                    {{ $exp->period }}@if($exp->location) · {{ $exp->location }}@endif
                                                </p>
                                            @endif
                                            @if($exp->description)
                                                <p class="mb-0">{!! nl2br(e($exp->description)) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted fst-italic mb-0">
                                    Belum ada pengalaman yang diisi.
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Educations --}}
                    @php
                        $educations = $personalData->educations ?? collect();
                    @endphp

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="section-title">Education</h3>

                            @if($educations->isNotEmpty())
                                @foreach($educations as $edu)
                                    <div class="timeline-item">
                                        <div>
                                            <h5 class="mb-0">{{ $edu->institution }}</h5>
                                            @if($edu->degree)
                                                <p class="text-muted mb-1">{{ $edu->degree }}</p>
                                            @endif
                                            @if($edu->period || $edu->location)
                                                <p class="text-primary mb-2">
                                                    {{ $edu->period }}@if($edu->location) · {{ $edu->location }}@endif
                                                </p>
                                            @endif
                                            @if($edu->description)
                                                <p class="mb-0">{!! nl2br(e($edu->description)) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted fst-italic mb-0">
                                    Belum ada riwayat pendidikan yang diisi.
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dark mode toggle script --}}
<script>
    (function () {
        const body = document.body;
        const toggleBtn = document.getElementById('theme-toggle');
        const toggleText = document.getElementById('theme-toggle-text');

        function applyTheme(theme) {
            body.setAttribute('data-theme', theme);
            if (toggleText) {
                toggleText.textContent = theme === 'dark' ? 'Light mode' : 'Dark mode';
            }
        }

        const storedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches;

        const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');
        applyTheme(initialTheme);

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const current = body.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
                const next = current === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', next);
                applyTheme(next);
            });
        }
    })();
</script>
</body>
</html>

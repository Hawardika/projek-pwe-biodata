@php
    // Biar aman kalau dipanggil dari create (belum ada data)
    $personalData = $personalData ?? null;
@endphp

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', optional($personalData)->name) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', optional($personalData)->title) }}">
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control"
           value="{{ old('email', optional($personalData)->email) }}">
</div>

<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control"
           value="{{ old('phone', optional($personalData)->phone) }}">
</div>

<div class="mb-3">
    <label class="form-label">Address</label>
    <textarea name="address" class="form-control" rows="2">{{ old('address', optional($personalData)->address) }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Birth Date</label>
    <input type="date" name="birth_date" class="form-control"
           value="{{ old('birth_date', optional(optional($personalData)->birth_date)->format('Y-m-d')) }}">
</div>

<div class="mb-3">
    <label class="form-label">Nationality</label>
    <input type="text" name="nationality" class="form-control"
           value="{{ old('nationality', optional($personalData)->nationality) }}">
</div>

<div class="mb-3">
    <label class="form-label">LinkedIn</label>
    <input type="text" name="linkedin" class="form-control"
           value="{{ old('linkedin', optional($personalData)->linkedin) }}">
</div>

<div class="mb-3">
    <label class="form-label">GitHub</label>
    <input type="text" name="github" class="form-control"
           value="{{ old('github', optional($personalData)->github) }}">
</div>

<div class="mb-3">
    <label class="form-label">Summary</label>
    <textarea name="summary" class="form-control" rows="3">{{ old('summary', optional($personalData)->summary) }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Skills (pisahkan dengan koma)</label>
    <input type="text" name="skills" class="form-control"
           value="{{ old('skills', optional($personalData)->skills) }}">
    <div class="form-text">Contoh: Laravel, PHP, JavaScript, MySQL</div>
</div>

<div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control">

    @if(optional($personalData)->photo)
        <div class="mt-2">
            <p class="mb-1">Foto saat ini:</p>
            <img src="{{ asset('storage/'. $personalData->photo) }}"
                 alt="Current photo"
                 class="img-thumbnail"
                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
        </div>
    @endif
</div>

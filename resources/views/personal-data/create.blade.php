<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Personal Data</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Buat Profil</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('personal-data.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('personal-data.partials.form-fields')

                <h3 class="mt-4 mb-3">Work Experience</h3>
                <div id="experience-container"></div>
                <button type="button" id="add-experience-btn" class="btn btn-outline-primary btn-sm mb-4">
                    + Tambah Experience
                </button>

                <h3 class="mt-4 mb-3">Education</h3>
                <div id="education-container"></div>
                <button type="button" id="add-education-btn" class="btn btn-outline-primary btn-sm mb-4">
                    + Tambah Education
                </button>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('personal-data.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- template sama persis dengan edit --}}
<template id="experience-template">
    <div class="card mb-3 experience-card p-3">
        <input type="hidden" name="experiences[__INDEX__][id]" value="">

        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control"
                   name="experiences[__INDEX__][title]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Company</label>
            <input type="text" class="form-control"
                   name="experiences[__INDEX__][company]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Location</label>
            <input type="text" class="form-control"
                   name="experiences[__INDEX__][location]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Period</label>
            <input type="text" class="form-control"
                   name="experiences[__INDEX__][period]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3"
                      name="experiences[__INDEX__][description]"></textarea>
        </div>

        <button type="button" class="btn btn-outline-danger btn-sm remove-experience">
            Hapus pengalaman ini
        </button>
    </div>
</template>

<template id="education-template">
    <div class="card mb-3 education-card p-3">
        <input type="hidden" name="educations[__INDEX__][id]" value="">

        <div class="mb-2">
            <label class="form-label">Institution</label>
            <input type="text" class="form-control"
                   name="educations[__INDEX__][institution]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Degree</label>
            <input type="text" class="form-control"
                   name="educations[__INDEX__][degree]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Location</label>
            <input type="text" class="form-control"
                   name="educations[__INDEX__][location]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Period</label>
            <input type="text" class="form-control"
                   name="educations[__INDEX__][period]" value="">
        </div>

        <div class="mb-2">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3"
                      name="educations[__INDEX__][description]"></textarea>
        </div>

        <button type="button" class="btn btn-outline-danger btn-sm remove-education">
            Hapus education ini
        </button>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let experienceIndex = 0;
        const expContainer = document.getElementById('experience-container');
        const expTemplate = document.getElementById('experience-template').innerHTML;
        const addExpBtn = document.getElementById('add-experience-btn');

        addExpBtn.addEventListener('click', function () {
            const html = expTemplate.replace(/__INDEX__/g, experienceIndex);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            expContainer.appendChild(wrapper.firstElementChild);
            experienceIndex++;
        });

        expContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-experience')) {
                const card = e.target.closest('.experience-card');
                card.remove();
            }
        });

        if (experienceIndex === 0) {
            addExpBtn.click();
        }

        let educationIndex = 0;
        const eduContainer = document.getElementById('education-container');
        const eduTemplate = document.getElementById('education-template').innerHTML;
        const addEduBtn = document.getElementById('add-education-btn');

        addEduBtn.addEventListener('click', function () {
            const html = eduTemplate.replace(/__INDEX__/g, educationIndex);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            eduContainer.appendChild(wrapper.firstElementChild);
            educationIndex++;
        });

        eduContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-education')) {
                const card = e.target.closest('.education-card');
                card.remove();
            }
        });

        if (educationIndex === 0) {
            addEduBtn.click();
        }
    });
</script>
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalDataController extends Controller
{
    public function index()
    {
        // load kedua relasi
        $personalData = PersonalData::with(['experiences', 'educations'])->first();

        if (!$personalData) {
            return redirect()->route('personal-data.create');
        }

        return view('personal-data.index', compact('personalData'));
    }

    public function create()
    {
        $personalData = new PersonalData();

        return view('personal-data.create', compact('personalData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
            'birth_date'  => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'linkedin'    => 'nullable|string|max:255',
            'github'      => 'nullable|string|max:255',
            'summary'     => 'nullable|string',
            'skills'      => 'nullable|string',
            'photo'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $personalData = PersonalData::create($data);

        // ============ WORK EXPERIENCE ============
        $experiencesInput = $request->input('experiences', []);
        $order = 1;

        foreach ($experiencesInput as $exp) {
            if (
                empty($exp['title']) &&
                empty($exp['company']) &&
                empty($exp['description'])
            ) {
                continue;
            }

            Experience::create([
                'personal_data_id' => $personalData->id,
                'title'            => $exp['title'] ?? null,
                'company'          => $exp['company'] ?? null,
                'location'         => $exp['location'] ?? null,
                'period'           => $exp['period'] ?? null,
                'description'      => $exp['description'] ?? null,
                'order'            => $order++,
            ]);
        }

        // ============ EDUCATION ============
        $educationsInput = $request->input('educations', []);
        $order = 1;

        foreach ($educationsInput as $edu) {
            if (
                empty($edu['institution']) &&
                empty($edu['degree']) &&
                empty($edu['description'])
            ) {
                continue;
            }

            Education::create([
                'personal_data_id' => $personalData->id,
                'institution'      => $edu['institution'] ?? null,
                'degree'           => $edu['degree'] ?? null,
                'location'         => $edu['location'] ?? null,
                'period'           => $edu['period'] ?? null,
                'description'      => $edu['description'] ?? null,
                'order'            => $order++,
            ]);
        }

        return redirect()->route('personal-data.index')
            ->with('success', 'Profil berhasil dibuat.');
    }

    public function edit(PersonalData $personalData)
    {
        $personalData->load(['experiences', 'educations']);

        return view('personal-data.edit', compact('personalData'));
    }

    public function update(Request $request, PersonalData $personalData)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:255',
            'address'     => 'nullable|string|max:255',
            'birth_date'  => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'linkedin'    => 'nullable|string|max:255',
            'github'      => 'nullable|string|max:255',
            'summary'     => 'nullable|string',
            'skills'      => 'nullable|string',
            'photo'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($personalData->photo) {
                Storage::disk('public')->delete($personalData->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $personalData->update($data);

        // ============ SYNC WORK EXPERIENCE ============
        $experiencesInput = $request->input('experiences', []);
        $keepExpIds = [];
        $order = 1;

        foreach ($experiencesInput as $exp) {
            if (
                empty($exp['title']) &&
                empty($exp['company']) &&
                empty($exp['description'])
            ) {
                continue;
            }

            if (!empty($exp['id'])) {
                $model = Experience::where('personal_data_id', $personalData->id)
                    ->where('id', $exp['id'])
                    ->first();

                if ($model) {
                    $model->update([
                        'title'       => $exp['title'] ?? null,
                        'company'     => $exp['company'] ?? null,
                        'location'    => $exp['location'] ?? null,
                        'period'      => $exp['period'] ?? null,
                        'description' => $exp['description'] ?? null,
                        'order'       => $order++,
                    ]);

                    $keepExpIds[] = $model->id;
                    continue;
                }
            }

            $model = Experience::create([
                'personal_data_id' => $personalData->id,
                'title'            => $exp['title'] ?? null,
                'company'          => $exp['company'] ?? null,
                'location'         => $exp['location'] ?? null,
                'period'           => $exp['period'] ?? null,
                'description'      => $exp['description'] ?? null,
                'order'            => $order++,
            ]);

            $keepExpIds[] = $model->id;
        }

        Experience::where('personal_data_id', $personalData->id)
            ->whereNotIn('id', $keepExpIds)
            ->delete();

        // ============ SYNC EDUCATION ============
        $educationsInput = $request->input('educations', []);
        $keepEduIds = [];
        $order = 1;

        foreach ($educationsInput as $edu) {
            if (
                empty($edu['institution']) &&
                empty($edu['degree']) &&
                empty($edu['description'])
            ) {
                continue;
            }

            if (!empty($edu['id'])) {
                $model = Education::where('personal_data_id', $personalData->id)
                    ->where('id', $edu['id'])
                    ->first();

                if ($model) {
                    $model->update([
                        'institution' => $edu['institution'] ?? null,
                        'degree'      => $edu['degree'] ?? null,
                        'location'    => $edu['location'] ?? null,
                        'period'      => $edu['period'] ?? null,
                        'description' => $edu['description'] ?? null,
                        'order'       => $order++,
                    ]);

                    $keepEduIds[] = $model->id;
                    continue;
                }
            }

            $model = Education::create([
                'personal_data_id' => $personalData->id,
                'institution'      => $edu['institution'] ?? null,
                'degree'           => $edu['degree'] ?? null,
                'location'         => $edu['location'] ?? null,
                'period'           => $edu['period'] ?? null,
                'description'      => $edu['description'] ?? null,
                'order'            => $order++,
            ]);

            $keepEduIds[] = $model->id;
        }

        Education::where('personal_data_id', $personalData->id)
            ->whereNotIn('id', $keepEduIds)
            ->delete();

        return redirect()->route('personal-data.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // 1. Import trait file upload
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class PortfolioManager extends Component
{
    use WithFileUploads; // 2. Gunakan trait di dalam class

    public $isEditMode = false;

    // Properti form profile
    public $profileId;
    public $name;
    public $headline;
    public $about;
    public $email;
    public $phone;
    public $avatar;      // Menampilkan nama file avatar lama
    public $newAvatar;   // Menampung file foto baru yang diunggah

    public function mount()
    {
        $profile = Profile::first();
        if ($profile) {
            $this->profileId = $profile->id;
            $this->name = $profile->name;
            $this->headline = $profile->headline;
            $this->about = $profile->about;
            $this->email = $profile->email;
            $this->phone = $profile->phone;
            $this->avatar = $profile->avatar;
        }
    }

    public function toggleEditMode()
    {
        $this->isEditMode = !$this->isEditMode;
    }

    public function saveProfile()
    {
        $validationRules = [
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ];

        // Jika ada foto baru yang diunggah, tambahkan validasi gambar
        if ($this->newAvatar) {
            $validationRules['newAvatar'] = 'image|max:2048'; // Maksimal 2MB
        }

        $this->validate($validationRules);

        $profile = Profile::find($this->profileId);
        
        $avatarPath = $this->avatar;

        // Proses simpan file ke storage jika user mengunggah foto baru
        if ($this->newAvatar) {
            // Hapus foto lama jika ada agar storage tidak penuh
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            
            // Simpan foto baru ke dalam folder 'avatars' di disk public
            $avatarPath = $this->newAvatar->store('avatars', 'public');
        }

        $profile->update([
            'name' => $this->name,
            'headline' => $this->headline,
            'about' => $this->about,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $avatarPath, // Simpan path foto ke database
        ]);

        // Reset properti foto sementara
        $this->newAvatar = null;
        $this->avatar = $profile->avatar;
        
        $this->isEditMode = false;
        session()->flash('message', 'Profil dan foto berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.portfolio-manager', [
            'profile' => Profile::first(),
            'experiences' => Experience::latest()->get(),
            'educations' => Education::all(),
            // Hanya tampilkan proyek yang sudah di-publish
            'projects' => Project::where('is_published', true)->latest()->get(),
            'skills' => Skill::where('type', 'skill')->get(),
            'certifications' => Skill::where('type', 'certification')->get(),
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;

class PortfolioManager extends Component
{
    // Set default layout for Livewire component to avoid using ->layout() in render
    protected $layout = 'layouts.app';
    public $isEditMode = false;

    public $profileId;
    public $name;
    public $headline;
    public $about;
    public $email;
    public $phone;

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
        }
    }

    public function toggleEditMode()
    {
        $this->isEditMode = !$this->isEditMode;
    }

    public function saveProfile()
    {
        // Validasi input wajib diisi
        $this->validate([
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $profile = Profile::find($this->profileId);
        $profile->update([
            'name' => $this->name,
            'headline' => $this->headline,
            'about' => $this->about,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->isEditMode = false;
        
        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.portfolio-manager', [
            'profile' => Profile::first(),
            'experiences' => Experience::latest()->get(),
            'educations' => Education::all(),
            'projects' => Project::latest()->get(),
            'skills' => Skill::where('type', 'skill')->get(),
            'certifications' => Skill::where('type', 'certification')->get(),
        ]);
    }
}
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
    public $isEditMode = false;

    public function toggleEditMode()
    {
        $this->isEditMode = !$this->isEditMode;
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
        ])->layout('layouts.app');
    }
}
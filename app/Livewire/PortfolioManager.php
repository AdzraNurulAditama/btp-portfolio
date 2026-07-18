<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use App\Services\PortfolioService; // Import Service Layer

class PortfolioManager extends Component
{
    use WithFileUploads;

    public $isEditMode = false;
    public $currentTab = 'profile';

    // Form Properti
    public $profileId, $name, $headline, $about, $email, $phone, $avatar, $newAvatar;
    public $selectedExperienceId, $exp_position, $exp_institution, $exp_period, $exp_description, $exp_sort_order = 0;
    public $selectedEducationId, $edu_institution, $edu_degree, $edu_period, $edu_description;
    public $selectedProjectId, $proj_name, $proj_link, $proj_tech_stack, $proj_description, $proj_is_published = true, $proj_sort_order = 0;
    public $selectedSkillId, $skill_name, $skill_type = 'skill', $skill_level;

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
        if ($this->isEditMode) { $this->currentTab = 'profile'; }
    }

    // ==========================================
    //      CALLING SERVICE LAYER FOR CRUD
    // ==========================================
    
    public function saveProfile(PortfolioService $service)
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'newAvatar' => $this->newAvatar ? 'image|max:2048' : 'nullable',
        ]);

        $profile = $service->updateProfile($data, $this->newAvatar);

        $this->profileId = $profile->id;
        $this->avatar = $profile->avatar;
        $this->newAvatar = null;
        session()->flash('message', 'Profil berhasil diperbarui via Service Layer!');
    }

    public function saveExperience(PortfolioService $service)
    {
        $data = $this->validate([
            'exp_position' => 'required|string|max:255',
            'exp_institution' => 'required|string|max:255',
            'exp_period' => 'required|string|max:255',
            'exp_description' => 'required|string',
            'exp_sort_order' => 'required|integer',
        ]);

        $service->saveExperience($data, $this->selectedExperienceId);
        $this->resetExperienceForm();
        session()->flash('message', 'Data pengalaman berhasil disimpan!');
    }

    public function editExperience($id)
    {
        $exp = Experience::findOrFail($id);
        $this->selectedExperienceId = $exp->id;
        $this->exp_position = $exp->position;
        $this->exp_institution = $exp->institution;
        $this->exp_period = $exp->period;
        $this->exp_description = $exp->description;
        $this->exp_sort_order = $exp->sort_order;
    }

    public function deleteExperience($id)
    {
        Experience::destroy($id);
        session()->flash('message', 'Data pengalaman berhasil dihapus!');
    }

    public function resetExperienceForm()
    {
        $this->selectedExperienceId = null;
        $this->exp_position = ''; $this->exp_institution = ''; $this->exp_period = ''; $this->exp_description = ''; $this->exp_sort_order = 0;
    }

    public function saveEducation(PortfolioService $service)
    {
        $data = $this->validate([
            'edu_institution' => 'required|string|max:255',
            'edu_degree' => 'required|string|max:255',
            'edu_period' => 'required|string|max:255',
        ]);

        $data['edu_description'] = $this->edu_description;

        $service->saveEducation($data, $this->selectedEducationId);
        $this->resetEducationForm();
        session()->flash('message', 'Data pendidikan berhasil disimpan!');
    }

    public function editEducation($id)
    {
        $edu = Education::findOrFail($id);
        $this->selectedEducationId = $edu->id;
        $this->edu_institution = $edu->institution;
        $this->edu_degree = $edu->degree;
        $edu->period = $edu->period;
        $this->edu_description = $edu->description;
    }

    public function deleteEducation($id)
    {
        Education::destroy($id);
        session()->flash('message', 'Data pendidikan berhasil dihapus!');
    }

    public function resetEducationForm()
    {
        $this->selectedEducationId = null;
        $this->edu_institution = ''; $this->edu_degree = ''; $this->edu_period = ''; $this->edu_description = '';
    }

    public function saveProject(PortfolioService $service)
    {
        $data = $this->validate([
            'proj_name' => 'required|string|max:255',
            'proj_tech_stack' => 'required|string|max:255',
            'proj_description' => 'required|string',
            'proj_sort_order' => 'required|integer',
        ]);
        
        $data['proj_link'] = $this->proj_link;
        $data['proj_is_published'] = $this->proj_is_published;

        $service->saveProject($data, $this->selectedProjectId);
        $this->resetProjectForm();
        session()->flash('message', 'Data proyek berhasil disimpan!');
    }

    public function editProject($id)
    {
        $proj = Project::findOrFail($id);
        $this->selectedProjectId = $proj->id;
        $this->proj_name = $proj->name;
        $this->proj_link = $proj->link;
        $this->proj_tech_stack = $proj->tech_stack;
        $this->proj_description = $proj->description;
        $this->proj_is_published = $proj->is_published;
        $this->proj_sort_order = $proj->sort_order;
    }

    public function deleteProject($id)
    {
        Project::destroy($id);
        session()->flash('message', 'Data proyek berhasil dihapus!');
    }

    public function resetProjectForm()
    {
        $this->selectedProjectId = null;
        $this->proj_name = ''; $this->proj_link = ''; $this->proj_tech_stack = ''; $this->proj_description = ''; $this->proj_is_published = true; $this->proj_sort_order = 0;
    }

    public function saveSkill(PortfolioService $service)
    {
        $data = $this->validate([
            'skill_name' => 'required|string|max:255',
            'skill_type' => 'required|in:skill,certification',
            'skill_level' => 'required|string|max:255',
        ]);

        $service->saveSkill($data, $this->selectedSkillId);
        $this->resetSkillForm();
        session()->flash('message', 'Data keahlian/sertifikasi berhasil disimpan!');
    }

    public function editSkill($id)
    {
        $sk = Skill::findOrFail($id);
        $this->selectedSkillId = $sk->id;
        $this->skill_name = $sk->name;
        $this->skill_type = $sk->type;
        $this->skill_level = $sk->level;
    }

    public function deleteSkill($id)
    {
        Skill::destroy($id);
        session()->flash('message', 'Data keahlian berhasil dihapus!');
    }

    public function resetSkillForm()
    {
        $this->selectedSkillId = null;
        $this->skill_name = ''; $this->skill_type = 'skill'; $this->skill_level = '';
    }

    #[\Livewire\Attributes\Layout('layouts.app')]
    public function render()
    {
        return view('livewire.portfolio-manager', [
            'profile' => Profile::first(),
            'experiences' => Experience::orderBy('sort_order', 'asc')->latest()->get(),
            'educations' => Education::all(),
            'projects' => Project::where('is_published', true)->orderBy('sort_order', 'asc')->latest()->get(),
            'skills' => Skill::where('type', 'skill')->get(),
            'certifications' => Skill::where('type', 'certification')->get(),
        ]);
    }
}
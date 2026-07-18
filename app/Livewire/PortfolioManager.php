<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class PortfolioManager extends Component
{
    use WithFileUploads;

    public $isEditMode = false;
    
    // Properti pengendali tab aktif
    public $currentTab = 'profile';

    // Form Data Diri (Profile)
    public $profileId;
    public $name;
    public $headline;
    public $about;
    public $email;
    public $phone;
    public $avatar;
    public $newAvatar;

    // Form Pengalaman (Experience)
    public $selectedExperienceId;
    public $exp_position;
    public $exp_institution;
    public $exp_period;
    public $exp_description;
    public $exp_sort_order = 0; // Pindah ke dalam class dengan benar

    // Form Pendidikan (Education)
    public $selectedEducationId;
    public $edu_institution;
    public $edu_degree;
    public $edu_period;
    public $edu_description;

    // Form Proyek (Project)
    public $selectedProjectId;
    public $proj_name;
    public $proj_link;
    public $proj_tech_stack;
    public $proj_description;
    public $proj_is_published = true;
    public $proj_sort_order = 0; // Pindah ke dalam class dengan benar

    // Form Keahlian (Skill)
    public $selectedSkillId;
    public $skill_name;
    public $skill_type = 'skill';
    public $skill_level;

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
        if ($this->isEditMode) {
            $this->currentTab = 'profile';
        }
    }

    // ==========================================
    //            CRUD LOGIC: PROFILE            
    // ==========================================
    public function saveProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'newAvatar' => $this->newAvatar ? 'image|max:2048' : 'nullable',
        ]);

        $profile = Profile::first() ?? new Profile();
        
        if ($this->newAvatar) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $profile->avatar = $this->newAvatar->store('avatars', 'public');
        }

        $profile->name = $this->name;
        $profile->headline = $this->headline;
        $profile->about = $this->about;
        $profile->email = $this->email;
        $profile->phone = $this->phone;
        $profile->save();

        $this->profileId = $profile->id;
        $this->avatar = $profile->avatar;
        $this->newAvatar = null;
        
        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    // ==========================================
    //          CRUD LOGIC: EXPERIENCE           
    // ==========================================
    public function saveExperience()
    {
        $this->validate([
            'exp_position' => 'required|string|max:255',
            'exp_institution' => 'required|string|max:255',
            'exp_period' => 'required|string|max:255',
            'exp_description' => 'required|string',
            'exp_sort_order' => 'required|integer',
        ]);

        if ($this->selectedExperienceId) {
            $exp = Experience::find($this->selectedExperienceId);
        } else {
            $exp = new Experience();
        }

        $exp->position = $this->exp_position;
        $exp->institution = $this->exp_institution;
        $exp->period = $this->exp_period;
        $exp->description = $this->exp_description;
        $exp->sort_order = $this->exp_sort_order; // Simpan urutan manual
        $exp->save();

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
        $this->exp_sort_order = $exp->sort_order; // Isi state edit
    }

    public function deleteExperience($id)
    {
        Experience::destroy($id);
        session()->flash('message', 'Data pengalaman berhasil dihapus!');
    }

    public function resetExperienceForm()
    {
        $this->selectedExperienceId = null;
        $this->exp_position = '';
        $this->exp_institution = '';
        $this->exp_period = '';
        $this->exp_description = '';
        $this->exp_sort_order = 0; // Reset ke default
    }

    // ==========================================
    //           CRUD LOGIC: EDUCATION           
    // ==========================================
    public function saveEducation()
    {
        $this->validate([
            'edu_institution' => 'required|string|max:255',
            'edu_degree' => 'required|string|max:255',
            'edu_period' => 'required|string|max:255',
        ]);

        $edu = $this->selectedEducationId ? Education::find($this->selectedEducationId) : new Education();
        $edu->institution = $this->edu_institution;
        $edu->degree = $this->edu_degree;
        $edu->period = $this->edu_period;
        $edu->description = $this->edu_description;
        $edu->save();

        $this->resetEducationForm();
        session()->flash('message', 'Data pendidikan berhasil disimpan!');
    }

    public function editEducation($id)
    {
        $edu = Education::findOrFail($id);
        $this->selectedEducationId = $edu->id;
        $this->edu_institution = $edu->institution;
        $this->edu_degree = $edu->degree;
        $this->edu_period = $edu->period;
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
        $this->edu_institution = '';
        $this->edu_degree = '';
        $this->edu_period = '';
        $this->edu_description = '';
    }

    // ==========================================
    //            CRUD LOGIC: PROJECT            
    // ==========================================
    public function saveProject()
    {
        $this->validate([
            'proj_name' => 'required|string|max:255',
            'proj_tech_stack' => 'required|string|max:255',
            'proj_description' => 'required|string',
            'proj_sort_order' => 'required|integer',
        ]);

        $proj = $this->selectedProjectId ? Project::find($this->selectedProjectId) : new Project();
        $proj->name = $this->proj_name;
        $proj->link = $this->proj_link;
        $proj->tech_stack = $this->proj_tech_stack;
        $proj->description = $this->proj_description;
        $proj->is_published = $this->proj_is_published;
        $proj->sort_order = $this->proj_sort_order; // Simpan urutan manual
        $proj->save();

        $this->resetProjectForm();
        session()->flash('message', 'Data proyek berhasil disimpan!');
    }

    public function editProject($id)
    {
        $proj = Project::findOrFail($id);
        $this->selectedProjectId = $proj->id;
        $this->proj_name = $proj->name;
        $this->proj_link = $proj->link;
        $proj->tech_stack = $proj->tech_stack;
        $proj->description = $proj->description;
        $this->proj_is_published = $proj->is_published;
        $this->proj_sort_order = $proj->sort_order; // Isi state edit
    }

    public function deleteProject($id)
    {
        Project::destroy($id);
        session()->flash('message', 'Data proyek berhasil dihapus!');
    }

    public function resetProjectForm()
    {
        $this->selectedProjectId = null;
        $this->proj_name = '';
        $this->proj_link = '';
        $this->proj_tech_stack = '';
        $this->proj_description = '';
        $this->proj_is_published = true;
        $this->proj_sort_order = 0; // Reset ke default
    }

    // ==========================================
    //             CRUD LOGIC: SKILL             
    // ==========================================
    public function saveSkill()
    {
        $this->validate([
            'skill_name' => 'required|string|max:255',
            'skill_type' => 'required|in:skill,certification',
            'skill_level' => 'required|string|max:255',
        ]);

        $sk = $this->selectedSkillId ? Skill::find($this->selectedSkillId) : new Skill();
        $sk->name = $this->skill_name;
        $sk->type = $this->skill_type;
        $sk->level = $this->skill_level;
        $sk->save();

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
        $this->skill_name = '';
        $this->skill_type = 'skill';
        $this->skill_level = '';
    }

    #[\Livewire\Attributes\Layout('layouts.app')]
    public function render()
    {
        return view('livewire.portfolio-manager', [
            'profile' => Profile::first(),
            // Diurutkan berdasarkan sort_order terkecil lebih dulu
            'experiences' => Experience::orderBy('sort_order', 'asc')->latest()->get(),
            'educations' => Education::all(),
            // Hanya tampilkan proyek yang dipublish & diurutkan berdasarkan sort_order
            'projects' => Project::where('is_published', true)->orderBy('sort_order', 'asc')->latest()->get(),
            'skills' => Skill::where('type', 'skill')->get(),
            'certifications' => Skill::where('type', 'certification')->get(),
        ]);
    }
}
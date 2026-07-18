<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    public function updateProfile(array $data, $newAvatar = null)
    {
        $profile = Profile::first() ?? new Profile();
        
        if ($newAvatar) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $profile->avatar = $newAvatar->store('avatars', 'public');
        }

        $profile->name = $data['name'];
        $profile->headline = $data['headline'];
        $profile->about = $data['about'];
        $profile->email = $data['email'];
        $profile->phone = $data['phone'];
        $profile->save();

        return $profile;
    }

    public function saveExperience(array $data, $id = null)
    {
        $exp = $id ? Experience::find($id) : new Experience();
        $exp->position = $data['exp_position'];
        $exp->institution = $data['exp_institution'];
        $exp->period = $data['exp_period'];
        $exp->description = $data['exp_description'];
        $exp->sort_order = $data['exp_sort_order'];
        $exp->save();
        return $exp;
    }

    public function saveEducation(array $data, $id = null)
    {
        $edu = $id ? Education::find($id) : new Education();
        $edu->institution = $data['edu_institution'];
        $edu->degree = $data['edu_degree'];
        $edu->period = $data['edu_period'];
        $edu->description = $data['edu_description'] ?? null;
        $edu->save();
        return $edu;
    }

    public function saveProject(array $data, $id = null)
    {
        $proj = $id ? Project::find($id) : new Project();
        $proj->name = $data['proj_name'];
        $proj->link = $data['proj_link'] ?? null;
        $proj->tech_stack = $data['proj_tech_stack'];
        $proj->description = $data['proj_description'];
        $proj->is_published = $data['proj_is_published'];
        $proj->sort_order = $data['proj_sort_order'];
        $proj->save();
        return $proj;
    }

    public function saveSkill(array $data, $id = null)
    {
        $sk = $id ? Skill::find($id) : new Skill();
        $sk->name = $data['skill_name'];
        $sk->type = $data['skill_type'];
        $sk->level = $data['skill_level'];
        $sk->save();
        return $sk;
    }
}
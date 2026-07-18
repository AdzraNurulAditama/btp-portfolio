<div class="min-h-screen bg-slate-50/50 pb-16 font-sans antialiased text-slate-600">
    <!-- Navbar / Header Premium -->
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/80 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <div class="relative flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-emerald-500"></span>
                </div>
                <span class="font-mono text-sm font-bold tracking-tight text-slate-800">btp_portfolio // adzra</span>
            </div>
            
            <!-- Tombol Toggle Mode -->
            <button 
                wire:click="toggleEditMode" 
                class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold tracking-wide transition-all duration-300 {{ $isEditMode ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/20 hover:bg-amber-600 hover:shadow-amber-600/30' : 'bg-slate-900 text-white shadow-lg shadow-slate-950/20 hover:bg-slate-800 hover:shadow-slate-950/30' }}"
            >
                @if($isEditMode)
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>View Mode</span>
                @else
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Mode</span>
                @endif
            </button>
        </div>
    </header>

    <main class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8">
        @if($isEditMode)
            <!-- ========================================== -->
            <!--            DASHBOARD / EDIT MODE           -->
            <!-- ========================================== -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                
                <!-- Sidebar Menu Dashboard -->
                <div class="space-y-3">
                    <div class="sticky top-24 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                        <h2 class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400">Navigasi CRUD</h2>
                        <nav class="space-y-1">
                            @foreach([
                                'profile' => ['📝', 'Data Diri'],
                                'experience' => ['💼', 'Pengalaman'],
                                'education' => ['🎓', 'Pendidikan'],
                                'project' => ['🚀', 'Proyek Pilihan'],
                                'skill' => ['🛠️', 'Keahlian']
                            ] as $tab => $info)
                                <button 
                                    wire:click="$set('currentTab', '{{ $tab }}')" 
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-left {{ $currentTab === $tab ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                                >
                                    <span>{{ $info[0] }}</span>
                                    <span>{{ $info[1] }}</span>
                                </button>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- Kolom Form Konten Dashboard -->
                <div class="space-y-8 lg:col-span-2">
                    
                    <!-- TAB 1: DATA DIRI -->
                    @if($currentTab === 'profile')
                    <section id="form-profile" class="rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm">
                        <h3 class="mb-6 text-lg font-bold text-slate-900 flex items-center gap-2">📝 Ubah Data Diri</h3>
                        
                        @if (session()->has('message'))
                            <div class="mb-6 rounded-xl bg-emerald-50 p-4 text-sm font-medium text-emerald-800 border border-emerald-100">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="saveProfile" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Input File / Avatar -->
                            <div class="flex items-center gap-6 rounded-xl border border-dashed border-slate-200 bg-slate-50/50 p-5 md:col-span-2">
                                <div class="relative h-20 w-20 flex-shrink-0 overflow-hidden rounded-full border border-slate-200 bg-slate-100 shadow-inner">
                                    @if ($newAvatar)
                                        <img src="{{ $newAvatar->temporaryUrl() }}" class="h-full w-full object-cover">
                                    @elseif ($avatar)
                                        <img src="{{ asset('storage/' . $avatar) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[10px] font-semibold uppercase text-slate-400">No Photo</div>
                                    @endif
                                    
                                    <div wire:loading wire:target="newAvatar" class="absolute inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs">
                                        <span class="animate-pulse text-[10px] font-medium text-white">Uploading...</span>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Foto Profil</label>
                                    <input type="file" wire:model="newAvatar" id="upload-avatar" class="text-xs text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-indigo-600 hover:file:bg-indigo-100 transition cursor-pointer">
                                    @error('newAvatar') <span class="block mt-1 text-xs font-medium text-rose-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Input Teks Profil -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                                <input type="text" wire:model="name" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="mb-2 block text-sm font-medium text-slate-700">Headline Profil</label>
                                <input type="text" wire:model="headline" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                @error('headline') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-slate-700">Tentang Saya (About)</label>
                                <textarea rows="4" wire:model="about" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10"></textarea>
                                @error('about') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end md:col-span-2">
                                <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-600/10 transition hover:bg-indigo-700 hover:shadow-indigo-700/20">
                                    Simpan Profil
                                </button>
                            </div>
                        </form>
                    </section>
                    @endif

                    <!-- TAB 2: KELOLA PENGALAMAN -->
                    @if($currentTab === 'experience')
                    <section id="form-experience" class="rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm space-y-8">
                        <div>
                            <h3 class="mb-6 text-lg font-bold text-slate-900 flex items-center gap-2">
                                💼 {{ $selectedExperienceId ? 'Ubah' : 'Tambah' }} Pengalaman
                            </h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Posisi / Jabatan</label>
                                    <input type="text" wire:model="exp_position" placeholder="Contoh: Staff Logistik" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('exp_position') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Institusi / Kegiatan</label>
                                    <input type="text" wire:model="exp_institution" placeholder="Contoh: Telkom University" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('exp_institution') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Periode Waktu</label>
                                    <input type="text" wire:model="exp_period" placeholder="Contoh: 2025" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('exp_period') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Urutan Tampil (Angka)</label>
                                    <input type="number" wire:model="exp_sort_order" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('exp_sort_order') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi Tugas</label>
                                    <textarea rows="3" wire:model="exp_description" placeholder="Tulis tugas dan tanggung jawab kamu..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10"></textarea>
                                    @error('exp_description') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                @if($selectedExperienceId)
                                    <button wire:click="resetExperienceForm" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                                @endif
                                <button wire:click="saveExperience" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-600/10 transition hover:bg-indigo-700">
                                    {{ $selectedExperienceId ? 'Simpan Perubahan' : 'Tambah Pengalaman' }}
                                </button>
                            </div>
                        </div>

                        <!-- Tabel Riwayat Pengalaman CRUD -->
                        <div class="border-t border-slate-100 pt-6">
                            <h4 class="mb-4 text-sm font-bold text-slate-800">Daftar Pengalaman Sekarang</h4>
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                                            <th class="p-4">Urutan</th>
                                            <th class="p-4">Jabatan & Tempat</th>
                                            <th class="p-4">Periode</th>
                                            <th class="p-4 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                                        @foreach($experiences as $exp)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4 font-mono text-xs text-slate-400">#{{ $exp->sort_order }}</td>
                                            <td class="p-4">
                                                <div class="font-bold text-slate-900">{{ $exp->position }}</div>
                                                <div class="text-xs text-slate-400">{{ $exp->institution }}</div>
                                            </td>
                                            <td class="p-4 text-xs font-mono text-slate-500">{{ $exp->period }}</td>
                                            <td class="p-4 text-center space-x-3">
                                                <button wire:click="editExperience({{ $exp->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs transition">Edit</button>
                                                <button wire:click="deleteExperience({{ $exp->id }})" class="text-rose-500 hover:text-rose-700 font-bold text-xs transition">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- TAB 3: KELOLA PENDIDIKAN -->
                    @if($currentTab === 'education')
                    <section id="form-education" class="rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm space-y-8">
                        <div>
                            <h3 class="mb-6 text-lg font-bold text-slate-900 flex items-center gap-2">
                                🎓 {{ $selectedEducationId ? 'Ubah' : 'Tambah' }} Pendidikan
                            </h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Institusi</label>
                                    <input type="text" wire:model="edu_institution" placeholder="Contoh: Telkom University" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('edu_institution') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Jenjang / Program Studi</label>
                                    <input type="text" wire:model="edu_degree" placeholder="Contoh: D3 Sistem Informasi" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('edu_degree') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Periode Pendidikan</label>
                                    <input type="text" wire:model="edu_period" placeholder="Contoh: 2024 - Sekarang" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('edu_period') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi Singkat</label>
                                    <textarea rows="3" wire:model="edu_description" placeholder="Info tambahan atau fokus keahlian akademik..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10"></textarea>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                @if($selectedEducationId)
                                    <button wire:click="resetEducationForm" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                                @endif
                                <button wire:click="saveEducation" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-600/10 transition hover:bg-indigo-700">
                                    {{ $selectedEducationId ? 'Simpan Perubahan' : 'Tambah Pendidikan' }}
                                </button>
                            </div>
                        </div>

                        <!-- Tabel List Riwayat Pendidikan -->
                        <div class="border-t border-slate-100 pt-6">
                            <h4 class="mb-4 text-sm font-bold text-slate-800">Daftar Pendidikan Tercatat</h4>
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                                            <th class="p-4">Institusi & Jenjang</th>
                                            <th class="p-4">Periode</th>
                                            <th class="p-4 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                                        @foreach($educations as $edu)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4">
                                                <div class="font-bold text-slate-900">{{ $edu->institution }}</div>
                                                <div class="text-xs text-slate-400">{{ $edu->degree }}</div>
                                            </td>
                                            <td class="p-4 text-xs font-mono text-slate-500">{{ $edu->period }}</td>
                                            <td class="p-4 text-center space-x-3">
                                                <button wire:click="editEducation({{ $edu->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs transition">Edit</button>
                                                <button wire:click="deleteEducation({{ $edu->id }})" class="text-rose-500 hover:text-rose-700 font-bold text-xs transition">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- TAB 4: KELOLA PROYEK -->
                    @if($currentTab === 'project')
                    <section id="form-project" class="rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm space-y-8">
                        <div>
                            <h3 class="mb-6 text-lg font-bold text-slate-900 flex items-center gap-2">
                                🚀 {{ $selectedProjectId ? 'Ubah' : 'Tambah' }} Proyek
                            </h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Proyek</label>
                                    <input type="text" wire:model="proj_name" placeholder="Contoh: Aplikasi E-Commerce Safae" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('proj_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tautan / Link Proyek</label>
                                    <input type="text" wire:model="proj_link" placeholder="Contoh: https://github.com/..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tech Stack Badge (Pisahkan dengan tanda koma)</label>
                                    <input type="text" wire:model="proj_tech_stack" placeholder="Contoh: Laravel, Tailwind CSS, Livewire, MySQL" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('proj_tech_stack') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Urutan Tampil Proyek (Angka kecil = paling atas)</label>
                                    <input type="number" wire:model="proj_sort_order" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('proj_sort_order') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi Lengkap Proyek</label>
                                    <textarea rows="3" wire:model="proj_description" placeholder="Ceritakan detail fitur proyek portfolio ini..." class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10"></textarea>
                                    @error('proj_description') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                
                                <!-- Switch Draft / Publish Toggle -->
                                <div class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-4 md:col-span-2">
                                    <input type="checkbox" wire:model="proj_is_published" id="proj_pub" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                                    <label for="proj_pub" class="text-sm font-medium text-slate-700 select-none cursor-pointer">
                                        Publish Proyek Langsung ke Publik
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                @if($selectedProjectId)
                                    <button wire:click="resetProjectForm" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                                @endif
                                <button wire:click="saveProject" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-600/10 transition hover:bg-indigo-700">
                                    {{ $selectedProjectId ? 'Simpan Perubahan' : 'Tambah Proyek' }}
                                </button>
                            </div>
                        </div>

                        <!-- Tabel Riwayat Proyek CRUD -->
                        <div class="border-t border-slate-100 pt-6">
                            <h4 class="mb-4 text-sm font-bold text-slate-800">Daftar Proyek Anda</h4>
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                                            <th class="p-4">Urutan</th>
                                            <th class="p-4">Nama Proyek</th>
                                            <th class="p-4">Tech Stack</th>
                                            <th class="p-4">Status</th>
                                            <th class="p-4 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                                        @foreach(\App\Models\Project::latest()->get() as $proj)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4 font-mono text-xs text-slate-400">#{{ $proj->sort_order }}</td>
                                            <td class="p-4 font-bold text-slate-900">{{ $proj->name }}</td>
                                            <td class="p-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach(explode(',', $proj->tech_stack) as $t)
                                                        <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded-md text-slate-600 font-mono font-medium">{{ trim($t) }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $proj->is_published ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                                    {{ $proj->is_published ? 'Published' : 'Draft' }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-center space-x-3">
                                                <button wire:click="editProject({{ $proj->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs transition">Edit</button>
                                                <button wire:click="deleteProject({{ $proj->id }})" class="text-rose-500 hover:text-rose-700 font-bold text-xs transition">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- TAB 5: KELOLA KEAHLIAN / SKILL -->
                    @if($currentTab === 'skill')
                    <section id="form-skill" class="rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm space-y-8">
                        <div>
                            <h3 class="mb-6 text-lg font-bold text-slate-900 flex items-center gap-2">
                                🛠️ {{ $selectedSkillId ? 'Ubah' : 'Tambah' }} Keahlian & Sertifikasi
                            </h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Keahlian / Judul Sertifikat</label>
                                    <input type="text" wire:model="skill_name" placeholder="Contoh: Laravel Development" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('skill_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tipe Kompetensi</label>
                                    <select wire:model="skill_type" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm bg-white transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                        <option value="skill">Keahlian Teknis (Skill)</option>
                                        <option value="certification">Sertifikasi Resmi (Certification)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="mb-2 block text-sm font-medium text-slate-700">Tingkat Kemahiran / Penerbit Instansi</label>
                                    <input type="text" wire:model="skill_level" placeholder="Contoh: Advanced / Dicoding Indonesia" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10">
                                    @error('skill_level') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                @if($selectedSkillId)
                                    <button wire:click="resetSkillForm" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                                @endif
                                <button wire:click="saveSkill" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-600/10 transition hover:bg-indigo-700">
                                    {{ $selectedSkillId ? 'Simpan Perubahan' : 'Tambah Data' }}
                                </button>
                            </div>
                        </div>

                        <!-- Tabel Riwayat Skill CRUD -->
                        <div class="border-t border-slate-100 pt-6">
                            <h4 class="mb-4 text-sm font-bold text-slate-800">Daftar Keahlian & Sertifikasi Terpasang</h4>
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 font-semibold text-xs uppercase tracking-wider">
                                            <th class="p-4">Kompetensi</th>
                                            <th class="p-4">Tipe</th>
                                            <th class="p-4">Keterangan</th>
                                            <th class="p-4 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                                        @foreach(\App\Models\Skill::all() as $sk)
                                        <tr class="hover:bg-slate-50/50 transition">
                                            <td class="p-4 font-bold text-slate-900">{{ $sk->name }}</td>
                                            <td class="p-4 text-xs font-mono uppercase text-slate-400 font-semibold">{{ $sk->type }}</td>
                                            <td class="p-4 text-xs text-slate-500">{{ $sk->level }}</td>
                                            <td class="p-4 text-center space-x-3">
                                                <button wire:click="editSkill({{ $sk->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs transition">Edit</button>
                                                <button wire:click="deleteSkill({{ $sk->id }})" class="text-rose-500 hover:text-rose-700 font-bold text-xs transition">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    @endif

                </div>
            </div>
        @else
            <!-- ========================================== -->
            <!--             VIEW MODE / PORTFOLIO          -->
            <!-- ========================================== -->
            <div class="space-y-12">
                <!-- Hero Profile Section Container -->
                @if($profile)
                    <section class="rounded-3xl border border-slate-100 bg-white p-8 md:p-12 shadow-sm flex flex-col md:flex-row items-center gap-8 md:gap-12 relative overflow-hidden">
                        <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-gradient-to-tr from-indigo-500/10 to-emerald-500/10 blur-3xl"></div>
                        
                        <div class="h-32 w-32 md:h-40 md:w-40 flex-shrink-0 rounded-full bg-gradient-to-tr from-indigo-500 to-emerald-400 p-1 shadow-md">
                            <div class="h-full w-full bg-white rounded-full overflow-hidden flex items-center justify-center border border-white">
                                @if($profile->avatar)
                                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $profile->name }}" class="h-full w-full object-cover">
                                @else
                                    <span class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-emerald-500 bg-clip-text text-transparent">
                                        {{ substr($profile->name, 0, 1) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-4 text-center md:text-left flex-1">
                            <h1 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight">{{ $profile->name }}</h1>
                            <p class="text-indigo-600 font-semibold text-lg md:text-xl">{{ $profile->headline }}</p>
                            <p class="text-slate-500 text-sm md:text-base max-w-2xl leading-relaxed">{{ $profile->about }}</p>
                            
                            <!-- Kontak Sosmed Terstruktur -->
                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-5 gap-y-2 pt-3 text-xs font-mono text-slate-400 border-t border-slate-50">
                                <span class="flex items-center gap-1.5 hover:text-slate-600 transition">📧 {{ $profile->email }}</span>
                                <span class="flex items-center gap-1.5 hover:text-slate-600 transition">📞 {{ $profile->phone }}</span>
                                <a href="https://github.com/AdzraNurulAditama" target="_blank" class="flex items-center gap-1.5 hover:text-indigo-600 font-bold transition">🌐 github.com/AdzraNurulAditama</a>
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Dua Kolom: Edukasi & Pengalaman Kerja -->
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <!-- Section Pendidikan -->
                    <section class="rounded-3xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm">
                        <h2 class="mb-8 text-xl font-bold text-slate-900 flex items-center gap-2.5">
                            <span>Riwayat Pendidikan</span>
                        </h2>
                        <div class="relative border-l border-slate-200 pl-6 ml-3 space-y-8">
                            @foreach($educations as $edu)
                                <div class="relative group">
                                    <div class="absolute -left-[31px] top-1.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-indigo-600 shadow-sm group-hover:bg-emerald-500 transition-colors duration-300"></div>
                                    <span class="inline-block text-[11px] font-mono font-bold tracking-wide text-indigo-600 bg-indigo-50 border border-indigo-100/50 px-2.5 py-0.5 rounded-md">{{ $edu->period }}</span>
                                    <h3 class="mt-2.5 text-base font-bold text-slate-800">{{ $edu->institution }}</h3>
                                    <p class="text-sm text-slate-600 font-medium">{{ $edu->degree }}</p>
                                    @if($edu->description)
                                        <p class="mt-1.5 text-xs text-slate-400 leading-relaxed">{{ $edu->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Section Pengalaman -->
                    <section class="rounded-3xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm">
                        <h2 class="mb-8 text-xl font-bold text-slate-900 flex items-center gap-2.5">
                            <span>Organisasi & Kepanitiaan</span>
                        </h2>
                        <div class="relative border-l border-slate-200 pl-6 ml-3 space-y-8">
                            @foreach($experiences as $exp)
                                <div class="relative group">
                                    <div class="absolute -left-[31px] top-1.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500 shadow-sm group-hover:bg-indigo-600 transition-colors duration-300"></div>
                                    <span class="inline-block text-[11px] font-mono font-bold tracking-wide text-emerald-600 bg-emerald-50 border border-emerald-100/50 px-2.5 py-0.5 rounded-md">{{ $exp->period }}</span>
                                    <h3 class="mt-2.5 text-base font-bold text-slate-800">{{ $exp->position }}</h3>
                                    <p class="text-sm text-slate-500 font-medium mb-1">{{ $exp->institution }}</p>
                                    <p class="text-xs text-slate-400 leading-relaxed">{{ $exp->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- Section Projects Grid -->
                <section class="space-y-6">
                    <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2.5">
                        <span>Proyek Pilihan</span>
                    </h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($projects as $project)
                            <div class="group rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                <div>
                                    <div class="flex items-start justify-between gap-4 mb-2">
                                        <h3 class="font-bold text-slate-800 text-base group-hover:text-indigo-600 transition-colors">{{ $project->name }}</h3>
                                        @if($project->link)
                                            <a href="{{ $project->link }}" target="_blank" class="text-slate-400 hover:text-slate-600 transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 leading-relaxed mb-5 line-clamp-3">{{ $project->description }}</p>
                                </div>
                                <div class="pt-3 border-t border-slate-50">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(explode(',', $project->tech_stack) as $tech)
                                            <span class="text-[10px] font-mono font-semibold text-slate-600 bg-slate-50 border border-slate-200/50 px-2 py-0.5 rounded-md">{{ trim($tech) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Section Skills & Certifications -->
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <!-- Technical Skills -->
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                            <span></span> Keahlian Teknis
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($skills as $skill)
                                <span class="text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200/40 px-3.5 py-1.5 rounded-xl transition hover:border-slate-300">
                                    {{ $skill->name }} 
                                    <span class="text-[10px] font-mono text-slate-400 font-medium ml-1">({{ $skill->level }})</span>
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sertifikasi -->
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 sm:p-8 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                            <span></span> Sertifikasi Resmi
                        </h2>
                        <div class="space-y-3">
                            @foreach($certifications as $cert)
                                <div class="flex items-center gap-3.5 p-3.5 rounded-xl bg-slate-50/50 border border-slate-100 hover:bg-slate-50 transition">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 border border-amber-100 text-lg shadow-xs">🎖️</div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800">{{ $cert->name }}</h4>
                                        <p class="text-xs font-mono font-medium text-slate-400 mt-0.5">{{ $cert->level }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
</div>
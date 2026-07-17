<div class="min-h-screen bg-gray-50 pb-12">
    <!-- Navbar / Header Keren -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="font-mono text-sm font-bold text-gray-700">btp_portfolio // adzra</span>
            </div>
            
            <!-- Tombol Toggle Mode Ujian BTP -->
            <button 
                wire:click="toggleEditMode" 
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-medium text-sm transition-all duration-200 {{ $isEditMode ? 'bg-amber-500 text-white shadow-amber-200 shadow-lg hover:bg-amber-600' : 'bg-indigo-600 text-white shadow-indigo-200 shadow-lg hover:bg-indigo-700' }}"
            >
                @if($isEditMode)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Lihat Portofolio (View Mode)
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Kelola Data (Edit Mode)
                @endif
            </button>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        @if($isEditMode)
            <!-- ========================================== -->
            <!--            DASHBOARD / EDIT MODE           -->
            <!-- ========================================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fadeIn">
                <!-- Sidebar Menu Dashboard -->
                <div class="space-y-3">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Dashboard CRUD</h2>
                        <nav class="space-y-1">
                            <a href="#form-profile" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-xl bg-gray-50 hover:bg-gray-100 transition">📝 Ubah Data Diri</a>
                            <a href="#form-experience" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-gray-50 transition">💼 Kelola Pengalaman</a>
                            <a href="#form-education" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-gray-50 transition">🎓 Kelola Pendidikan</a>
                            <a href="#form-project" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-gray-50 transition">🚀 Kelola Proyek</a>
                            <a href="#form-skill" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 rounded-xl hover:bg-gray-50 transition">🛠️ Kelola Keahlian</a>
                        </nav>
                    </div>
                </div>

                <!-- Kolom Form Konten Dashboard -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Form Data Diri -->
                    <section id="form-profile" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">📝 Ubah Data Diri</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ $profile->name ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Headline Profil</label>
                                <input type="text" value="{{ $profile->headline ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tentang Saya (About)</label>
                                <textarea rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">{{ $profile->about ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-6 py-2.5 rounded-xl shadow-md transition">Simpan Profil</button>
                        </div>
                    </section>

                    <!-- Form Pengalaman Baru -->
                    <section id="form-experience" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">💼 Tambah Pengalaman</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Posisi / Jabatan</label>
                                <input type="text" placeholder="Contoh: Staff Logistik" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Institusi / Kegiatan</label>
                                <input type="text" placeholder="Contoh: Telkom University" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Periode Waktu</label>
                                <input type="text" placeholder="Contoh: 2025" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Tugas</label>
                                <textarea rows="3" placeholder="Tulis tugas dan tanggung jawab kamu..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm"></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-6 py-2.5 rounded-xl shadow-md transition">Tambah Pengalaman</button>
                        </div>
                    </section>
                </div>
            </div>
        @else
            <!-- ========================================== -->
            <!--             VIEW MODE / PORTFOLIO          -->
            <!-- ========================================== -->
            <div class="space-y-12 animate-fadeIn">
                <!-- Hero Profile Section -->
                @if($profile)
                    <section class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8">
                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-gradient-to-tr from-indigo-500 to-emerald-400 p-1 flex-shrink-0">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center text-4xl font-bold text-indigo-600">
                                {{ substr($profile->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="space-y-4 text-center md:text-left flex-1">
                            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">{{ $profile->name }}</h1>
                            <p class="text-indigo-600 font-medium text-lg">{{ $profile->headline }}</p>
                            <p class="text-gray-500 text-sm md:text-base max-w-2xl leading-relaxed">{{ $profile->about }}</p>
                            
                            <!-- Kontak Sosmed Mini -->
                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 pt-2 text-xs text-gray-500 font-mono">
                                <span class="flex items-center gap-1">📧 {{ $profile->email }}</span>
                                <span class="flex items-center gap-1">📞 {{ $profile->phone }}</span>
                                @if($profile->github)<span class="flex items-center gap-1">🌐 github.com/Adzra</span>@endif
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Dua Kolom: Edukasi & Pengalaman Kerja -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Section Pendidikan -->
                    <section class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">🎓 Riwayat Pendidikan</h2>
                        <div class="space-y-6 relative border-l-2 border-gray-100 pl-5 ml-2">
                            @foreach($educations as $edu)
                                <div class="relative">
                                    <div class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-indigo-500 ring-4 ring-white"></div>
                                    <span class="text-xs font-mono font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">{{ $edu->period }}</span>
                                    <h3 class="text-base font-bold text-gray-800 mt-2">{{ $edu->institution }}</h3>
                                    <p class="text-sm text-gray-600 font-medium">{{ $edu->degree }}</p>
                                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $edu->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Section Pengalaman -->
                    <section class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">💼 Organisasi & Kepanitiaan</h2>
                        <div class="space-y-6 relative border-l-2 border-gray-100 pl-5 ml-2">
                            @foreach($experiences as $exp)
                                <div class="relative">
                                    <div class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-white"></div>
                                    <span class="text-xs font-mono font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">{{ $exp->period }}</span>
                                    <h3 class="text-base font-bold text-gray-800 mt-2">{{ $exp->position }}</h3>
                                    <p class="text-sm text-gray-500 font-medium mb-1">{{ $exp->institution }}</p>
                                    <p class="text-xs text-gray-400 leading-relaxed">{{ $exp->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- Section Projects Grid -->
                <section class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">🚀 Proyek Pilihan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($projects as $project)
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                                <div>
                                    <h3 class="font-bold text-gray-800 text-base mb-2">{{ $project->name }}</h3>
                                    <p class="text-xs text-gray-400 leading-relaxed mb-4 line-clamp-3">{{ $project->description }}</p>
                                </div>
                                <div>
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        @foreach(explode(',', $project->tech_stack) as $tech)
                                            <span class="text-[10px] font-mono font-medium text-gray-600 bg-gray-100 px-2 py-0.5 rounded">{{ trim($tech) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Section Skills & Certifications -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Technical Skills -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">🛠️ Keahlian Teknis</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($skills as $skill)
                                <span class="text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200/60 px-3.5 py-1.5 rounded-xl">{{ $skill->name }} <span class="text-[10px] font-mono text-gray-400 ml-1">({{ $skill->level }})</span></span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sertifikasi -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">📜 Sertifikasi Resmi</h2>
                        <div class="space-y-3">
                            @foreach($certifications as $cert)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                                    <span class="text-xl">🎖️</span>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-800">{{ $cert->name }}</h4>
                                        <p class="text-xs text-gray-400 font-mono">{{ $cert->level }}</p>
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
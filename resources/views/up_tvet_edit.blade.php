<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="text-2xl">✏️</span> Kemaskini Borang Permohonan TVET
                </h2>
                <p class="text-xs text-gray-500 mt-1">Kemaskini butiran permohonan kursus TVET anda.</p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m7-7l-7-7m7 7V6"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('up_tvet_error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg">
                    {{ session('up_tvet_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('up-tvet.update', $upTvetApplication) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>👤</span> Maklumat Peribadi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="full_name" value="Nama Penuh" />
                            <x-text-input id="full_name" class="block mt-1 w-full bg-gray-50" type="text" name="full_name" :value="$upTvetApplication->full_name" disabled />
                        </div>

                        <div>
                            <x-input-label for="email" value="Alamat E-mel" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-50" type="email" name="email" :value="$upTvetApplication->email" disabled />
                        </div>

                        <div>
                            <x-input-label for="ic_number" value="No. Kad Pengenalan" />
                            <x-text-input id="ic_number" class="block mt-1 w-full" type="text" name="ic_number" :value="old('ic_number', $upTvetApplication->ic_number)" placeholder="cth: 020512015522" required />
                            <x-input-error :messages="$errors->get('ic_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone_number" value="No. Telefon" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number', $upTvetApplication->phone_number)" placeholder="cth: 0123456789" required />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>📍</span> Alamat
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <x-input-label for="address" value="Alamat Penuh" />
                            <textarea id="address" name="address" rows="2" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20" placeholder="Alamat rumah lengkap">{{ old('address', $upTvetApplication->address) }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" value="Bandar" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $upTvetApplication->city)" placeholder="Bandar" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="state" value="Negeri" />
                            <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $upTvetApplication->state)" placeholder="Negeri" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="postcode" value="Poskod" />
                            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode', $upTvetApplication->postcode)" placeholder="Poskod" />
                            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Education Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>🎓</span> Maklumat Pendidikan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="education_level" value="Tahap Pendidikan" />
                            <x-text-input id="education_level" class="block mt-1 w-full" type="text" name="education_level" :value="old('education_level', $upTvetApplication->education_level)" placeholder="cth: SPM, STPM, Diploma" />
                            <x-input-error :messages="$errors->get('education_level')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="school_name" value="Nama Sekolah" />
                            <x-text-input id="school_name" class="block mt-1 w-full" type="text" name="school_name" :value="old('school_name', $upTvetApplication->school_name)" placeholder="Nama sekolah terakhir" />
                            <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="graduation_year" value="Tahun Tamat" />
                            <x-text-input id="graduation_year" class="block mt-1 w-full" type="number" name="graduation_year" :value="old('graduation_year', $upTvetApplication->graduation_year)" placeholder="cth: 2023" min="1900" max="2100" />
                            <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Course Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-theme-accent">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>📚</span> Maklumat Kursus Dipohon
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="course_interest" value="Pilihan Kursus Yang Ditawarkan" />
                            <select id="course_interest" name="course_interest"
                                    class="block mt-1 w-full rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20 text-sm py-2.5 font-medium"
                                    required>
                                <option value="" disabled>-- Sila Pilih Kursus TVET --</option>
                                @if(isset($courses) && $courses->count() > 0)
                                    @foreach($courses->groupBy(fn($c) => $c->category ? $c->category->name : 'Umum') as $categoryName => $catCourses)
                                        <optgroup label="Bidang: {{ $categoryName }}">
                                            @foreach($catCourses as $course)
                                                <option value="{{ $course->name }}" {{ old('course_interest', $upTvetApplication->course_interest) == $course->name ? 'selected' : '' }}>
                                                    {{ $course->name }} ({{ $course->duration ?? 'Sijil' }})
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @else
                                    <option value="" disabled>Tiada kursus didaftarkan</option>
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('course_interest')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="why_choose_course" value="Kenapa Pilih Kursus Ini?" />
                            <textarea id="why_choose_course" name="why_choose_course" rows="3" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20" placeholder="Terangkan sebab atau minat anda memilih kursus ini...">{{ old('why_choose_course', $upTvetApplication->why_choose_course) }}</textarea>
                            <x-input-error :messages="$errors->get('why_choose_course')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Parent Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>👨‍👩‍👧</span> Maklumat Ibu Bapa
                    </h3>

                    <div class="space-y-6">
                        <!-- Father Information -->
                        <div class="border-b border-gray-200 pb-4">
                            <h4 class="text-md font-semibold text-gray-700 mb-3">Maklumat Bapa</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="father_name" value="Nama Bapa" />
                                    <x-text-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name', $upTvetApplication->father_name)" placeholder="Nama penuh bapa" />
                                    <x-input-error :messages="$errors->get('father_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="father_contact" value="No. Telefon Bapa" />
                                    <x-text-input id="father_contact" class="block mt-1 w-full" type="text" name="father_contact" :value="old('father_contact', $upTvetApplication->father_contact)" placeholder="cth: 0123456789" />
                                    <x-input-error :messages="$errors->get('father_contact')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="father_occupation" value="Pekerjaan Bapa" />
                                    <x-text-input id="father_occupation" class="block mt-1 w-full" type="text" name="father_occupation" :value="old('father_occupation', $upTvetApplication->father_occupation)" placeholder="Pekerjaan bapa" />
                                    <x-input-error :messages="$errors->get('father_occupation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Mother Information -->
                        <div>
                            <h4 class="text-md font-semibold text-gray-700 mb-3">Maklumat Ibu</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="mother_name" value="Nama Ibu" />
                                    <x-text-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" :value="old('mother_name', $upTvetApplication->mother_name)" placeholder="Nama penuh ibu" />
                                    <x-input-error :messages="$errors->get('mother_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="mother_contact" value="No. Telefon Ibu" />
                                    <x-text-input id="mother_contact" class="block mt-1 w-full" type="text" name="mother_contact" :value="old('mother_contact', $upTvetApplication->mother_contact)" placeholder="cth: 0123456789" />
                                    <x-input-error :messages="$errors->get('mother_contact')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="mother_occupation" value="Pekerjaan Ibu" />
                                    <x-text-input id="mother_occupation" class="block mt-1 w-full" type="text" name="mother_occupation" :value="old('mother_occupation', $upTvetApplication->mother_occupation)" placeholder="Pekerjaan ibu" />
                                    <x-input-error :messages="$errors->get('mother_occupation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Total Income -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="total_income" value="Jumlah Pendapatan Isi Rumah (RM)" />
                                    <x-text-input id="total_income" class="block mt-1 w-full" type="number" name="total_income" :value="old('total_income', $upTvetApplication->total_income)" placeholder="cth: 3000.00" step="0.01" min="0" />
                                    <x-input-error :messages="$errors->get('total_income')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>📞</span> Kontak Kecemasan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="emergency_contact_name" value="Nama Kontak Kecemasan" />
                            <x-text-input id="emergency_contact_name" class="block mt-1 w-full" type="text" name="emergency_contact_name" :value="old('emergency_contact_name', $upTvetApplication->emergency_contact_name)" placeholder="Nama" />
                            <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_phone" value="Telefon Kecemasan" />
                            <x-text-input id="emergency_contact_phone" class="block mt-1 w-full" type="text" name="emergency_contact_phone" :value="old('emergency_contact_phone', $upTvetApplication->emergency_contact_phone)" placeholder="No. telefon" />
                            <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_relationship" value="Hubungan" />
                            <x-text-input id="emergency_contact_relationship" class="block mt-1 w-full" type="text" name="emergency_contact_relationship" :value="old('emergency_contact_relationship', $upTvetApplication->emergency_contact_relationship)" placeholder="cth: Ibu/Bapa/Keluarga" />
                            <x-input-error :messages="$errors->get('emergency_contact_relationship')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Invitation Officer -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-theme-blue mb-4 flex items-center gap-2">
                        <span>👔</span> Nama Pegawai Jemputan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="invitation_officer_name" value="Nama Pegawai Jemputan" />
                            <x-text-input id="invitation_officer_name" class="block mt-1 w-full" type="text" name="invitation_officer_name" :value="old('invitation_officer_name', $upTvetApplication->invitation_officer_name)" placeholder="Nama pegawai yang menjemput" />
                            <x-input-error :messages="$errors->get('invitation_officer_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="invitation_officer_contact" value="No. Telefon Pegawai Jemputan" />
                            <x-text-input id="invitation_officer_contact" class="block mt-1 w-full" type="text" name="invitation_officer_contact" :value="old('invitation_officer_contact', $upTvetApplication->invitation_officer_contact)" placeholder="No. telefon pegawai" />
                            <x-input-error :messages="$errors->get('invitation_officer_contact')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-theme-blue hover:bg-theme-purple text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

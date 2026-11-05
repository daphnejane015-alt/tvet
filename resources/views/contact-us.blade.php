<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-theme-dark leading-tight">
                {{ __('Contact Us') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-theme-cream via-white to-theme-light min-h-screen py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- HEADER HERO BANNER -->
            <div class="relative bg-gradient-to-br from-theme-dark via-theme-blue to-[#133d63] text-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-theme-purple/30 overflow-hidden">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-theme-yellow/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-theme-accent/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-3xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-theme-yellow/20 border border-theme-yellow/40 text-theme-yellow text-xs font-bold uppercase tracking-wider">
                        <span>💬 Bantuan &amp; Pertanyaan</span>
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                        Hubungi Pasukan AceTVET
                    </h1>
                    <p class="text-slate-200 text-xs sm:text-sm leading-relaxed">
                        Ada pertanyaan mengenai kemasukan program TVET, persijilan SKM, atau penempatan kursus? Sila hubungi kami.
                    </p>
                </div>
            </div>

            <!-- GRID: CONTACT DETAILS & GOOGLE MAPS -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: CONTACT INFO CARDS -->
                <div class="lg:col-span-5 space-y-5">
                    
                    <!-- WHATSAPP CONTACT CARD -->
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-emerald-100 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 text-emerald-600 flex items-center justify-center text-2xl shrink-0 shadow-xs">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                    WhatsApp Rasmi
                                </span>
                                <h3 class="text-base sm:text-lg font-extrabold text-theme-dark mt-1">
                                    Ahli AceTVET 
                                </h3>
                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                    Klik butang di bawah untuk berbual terus bersama pegawai kami di WhatsApp.
                                </p>
                                <a href="https://wa.me/60164801473?text=Hai%20AceTVET,%20saya%20ingin%20bertanya%20tentang%20kemasukan%20kursus%20TVET" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="mt-4 inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                    <span>Buka WhatsApp Sekarang</span>
                                    <span>💬</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ADDRESS LOCATION CARD -->
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-theme-blue/15 shadow-lg space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-theme-blue/15 text-theme-blue flex items-center justify-center text-2xl shrink-0 shadow-xs">
                                📍
                            </div>
                            <div class="flex-1">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-theme-blue bg-theme-blue/10 px-2.5 py-0.5 rounded-full border border-theme-blue/20">
                                    Alamat Pejabat Operasi
                                </span>
                                <h3 class="text-sm sm:text-base font-extrabold text-theme-dark mt-2 leading-relaxed">
                                    NO 37-2, JALAN MPK 4,<br>
                                    TAMAN BUKIT KEPAYANG,<br>
                                    70300 SEREMBAN,<br>
                                    71700 NEGERI SEMBILAN.
                                </h3>
                                <p class="text-xs text-slate-500 mt-2">
                                    Waktu Operasi: Isnin – Khamis (9:00 AM – 5:30 PM)
                                </p>
                                 <p class="text-xs text-slate-500 mt-2">
                                    Waktu Operasi: Jumaat (8:30 AM – 12:30 PM)
                                </p>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center gap-3">
                            <a href="https://www.google.com/maps/search/?api=1&query=NO+37-2+JALAN+MPK+4+TAMAN+BUKIT+KEPAYANG+70300+SEREMBAN+NEGERI+SEMBILAN" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                <span>Buka di Google Maps</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- QUICK NOTICE CARD -->
                    <div class="bg-gradient-to-br from-theme-light/60 to-white rounded-2xl p-5 border border-theme-beige/40 shadow-xs">
                        <div class="flex items-center gap-2 text-xs font-bold text-theme-dark">
                            <span>📌</span>
                            <span>Panduan Lawatan</span>
                        </div>
                        <p class="text-[11px] sm:text-xs text-slate-600 mt-1.5 leading-relaxed">
                            Bagi sesi perundingan bersemuka atau serahan dokumen permohonan, anda disyorkan membuat temujanji terlebih dahulu melalui WhatsApp.
                        </p>
                    </div>

                </div>

                <!-- RIGHT COLUMN: FUNCTIONAL GOOGLE MAP EMBED & INTERACTIVE OVERLAY -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl p-5 sm:p-7 border border-theme-blue/15 shadow-xl space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-theme-accent bg-theme-accent/10 px-2.5 py-0.5 rounded-full border border-theme-accent/20">
                                    Navigasi Lokasi
                                </span>
                                <h3 class="text-base sm:text-lg font-extrabold text-theme-dark mt-1">
                                    Peta Lokasi Google Maps
                                </h3>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query=NO+37-2+JALAN+MPK+4+TAMAN+BUKIT+KEPAYANG+70300+SEREMBAN+NEGERI+SEMBILAN" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 text-xs font-extrabold text-theme-blue hover:text-theme-accent transition">
                                <span>Lihat Peta Penuh</span>
                                <span>🗺️</span>
                            </a>
                        </div>

                        <!-- MAP EMBED CONTAINER -->
                        <div class="relative w-full h-[400px] sm:h-[480px] rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                            <!-- Clickable direct map link banner on top of map -->
                            <a href="https://www.google.com/maps/search/?api=1&query=NO+37-2+JALAN+MPK+4+TAMAN+BUKIT+KEPAYANG+70300+SEREMBAN+NEGERI+SEMBILAN" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               title="Klik untuk buka terus di Google Maps App/Web"
                               class="absolute top-3 right-3 z-10 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/95 hover:bg-white text-theme-dark text-xs font-extrabold shadow-md border border-slate-200 backdrop-blur-md transition-all duration-200 hover:scale-105">
                                <span>Buka di Peta</span>
                                <svg class="w-3.5 h-3.5 text-theme-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>

                            <!-- Functional Google Maps iFrame -->
                            <iframe 
                                class="w-full h-full border-0"
                                src="https://maps.google.com/maps?q=NO%2037-2%20JALAN%20MPK%204%20TAMAN%20BUKIT%20KEPAYANG%2070300%20SEREMBAN%20NEGERI%20SEMBILAN&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <!-- FOOTNOTE UNDER MAP -->
                        <div class="flex items-center justify-between text-xs text-slate-500 pt-1 px-1">
                            <span>Taman Bukit Kepayang, 70300 Seremban</span>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=NO+37-2+JALAN+MPK+4+TAMAN+BUKIT+KEPAYANG+70300+SEREMBAN+NEGERI+SEMBILAN" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="font-bold text-theme-blue hover:underline">
                                Dapatkan Arah Pandu (Directions) →
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


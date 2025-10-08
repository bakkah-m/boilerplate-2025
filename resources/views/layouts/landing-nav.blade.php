<nav class="bg-base-100 sticky top-0 shadow z-[500] navbar lg:px-24 py-4">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 lg:pl-4 relative">
        <div class="flex justify-between h-16">

            <div class="flex gap-4">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center gap-2 cursor-pointer z-[501]">
                        <img class="h-12" src="{{ url('/logo.png') }}" />
                        <p class="text-3xl font-black text-pr-red">PPRPI</p>
                    </a>
                </div>

            </div>

        </div>

        <nav class="absolute inset-0 items-center justify-center hidden lg:flex">
            <ul class="flex gap-8 text-lg">
                <li>
                    <div class="dropdown dropdown-start">
                        <div tabindex="0" role="button" class="cursor-pointer text-base-content rounded-field flex items-end">
                            Profil
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M16.53 9.47a.75.75 0 0 1 0 1.06L12 15.06l-4.53-4.53a.75.75 0 1 1 1.06-1.06L12 12.94l3.47-3.47a.75.75 0 0 1 1.06 0"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu dropdown-content bg-white rounded-box z-1 mt-4 w-52 p-2 shadow-sm">
                            <li class="hover:text-white"><a href="{{ route('visi-misi') }}">Visi dan Misi</a></li>
                            <li class="hover:text-white"><a>AD/ART</a></li>
                            <li class="hover:text-white"><a>Program Kerja</a></li>
                            <li class="hover:text-white"><a>Struktur Administrasi</a></li>
                            <li class="hover:text-white"><a>Kepengurusan DPP</a></li>
                            <li class="hover:text-white"><a>Kepengurusan Wilayah</a></li>
                            <li class="hover:text-white"><a>Kepengurusan Sektor</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                   <a>Sejarah</a> 
                </li>
                <li>
                    <div class="dropdown dropdown-start">
                        <div tabindex="0" role="button" class="cursor-pointer text-base-content rounded-field flex items-end">
                            Tarombo
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M16.53 9.47a.75.75 0 0 1 0 1.06L12 15.06l-4.53-4.53a.75.75 0 1 1 1.06-1.06L12 12.94l3.47-3.47a.75.75 0 0 1 1.06 0"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu dropdown-content bg-white rounded-box z-1 mt-4 w-52 p-2 shadow-sm">
                            <li class="hover:text-white"><a href="{{ route('raja-pasaribu') }}">Raja Pasaribu</a></li>
                            <li class="hover:text-white"><a href="{{ route('habeahan') }}">Habeahan</a></li>
                            <li class="hover:text-white"><a href="{{ route('bondar') }}">Bondar</a></li>
                            <li class="hover:text-white"><a href="{{ route('gorat') }}">Gorat</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                   <a>Berita</a> 
                </li>
            </ul>
        </nav>
    </div>
</nav>
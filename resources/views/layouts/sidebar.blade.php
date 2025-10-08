<div class="drawer size-auto fixed z-[499]" id="sidebar-drawer">

    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var value = localStorage.getItem('sidebar');
            var toggle = document.getElementById('my-drawer-2');
            var mainContent = document.getElementById('main-content');

            if (value === 'open') {
                toggle.checked = true;
            }

            toggle.addEventListener('change', function () {
                if (toggle.checked) {
                    localStorage.setItem('sidebar', 'open');
                    mainContent.classList.add('lg:pl-80');
                } else {
                    localStorage.setItem('sidebar', 'close');
                    mainContent.classList.remove('lg:pl-80');
                }
            })
        })
    </script>

    <div class="drawer-side lg:shadow lg:w-80">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay lg:hidden"></label>
        <ul
            class="menu bg-base-100 text-base min-h-full pt-24 w-80 p-4 text-neutral-700 font-semibold gap-2 overflow-y-scroll flex flex-col lg:shadow">
            <!-- Sidebar content here -->
            <div class="divider m-0 my-2 text-sm text-base-content">General</div>
            <li>
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('users.index') ? 'menu-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                    </svg>
                    <span>Manajemen User</span>
                </a>
            </li>
            <div class="divider m-0 my-2 text-sm text-base-content">Data Master</div>
            <li>
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('habeahan.index') ? 'menu-active' : '' }}"
                    href="{{ route('habeahan.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 1a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 11 5.79V7H7a2 2 0 0 0-2 2v.71A2.5 2.5 0 0 0 3.5 12A2.5 2.5 0 0 0 5 14.29V15H4a2 2 0 0 0-2 2v1.21A2.5 2.5 0 0 0 .5 20.5A2.5 2.5 0 0 0 3 23a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 4 18.21V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 9 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2H7v-.71A2.5 2.5 0 0 0 8.5 12A2.5 2.5 0 0 0 7 9.71V9h10v.71A2.5 2.5 0 0 0 15.5 12a2.5 2.5 0 0 0 1.5 2.29V15h-1a2 2 0 0 0-2 2v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 15 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17h4v1.21a2.5 2.5 0 0 0-1.5 2.29A2.5 2.5 0 0 0 21 23a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-1.5-2.29V17a2 2 0 0 0-2-2h-1v-.71A2.5 2.5 0 0 0 20.5 12A2.5 2.5 0 0 0 19 9.71V9a2 2 0 0 0-2-2h-4V5.79a2.5 2.5 0 0 0 1.5-2.29A2.5 2.5 0 0 0 12 1m0 1.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M6 11a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m12 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M3 19.5a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1m6 0a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1" />
                    </svg>
                    <span>Habeahan</span>
                </a>
            </li>
            {{-- <li>
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('users.index') ? 'menu-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                    </svg>
                    <span>Bondar</span>
                </a>
            </li>
            <li>
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('users.index') ? 'menu-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                    </svg>
                    <span>Gorat</span>
                </a>
            </li> --}}


            <div class="divider m-0 my-2 text-sm text-base-content md:hidden">System</div>
            <li class="md:hidden">
                <a class="flex gap-2 items-center p-3 text-base-content {{ request()->routeIs('profile.edit') ? 'menu-active' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                            <path
                                d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21" />
                        </g>
                    </svg>
                    <span>Profile</span>
                </a>
            </li>
            <li class="md:hidden">
                <a onclick="logoutModal.showModal()" class="flex gap-2 items-center p-3 text-base-content">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                    </svg>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
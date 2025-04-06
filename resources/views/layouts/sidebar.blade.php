<div class="drawer lg:drawer-open size-auto fixed z-[499]">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />

    <div class="drawer-side shadow">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul
            class="menu bg-white text-base min-h-full mt-20 lg:mt-0 w-80 p-4 text-neutral-700 font-semibold gap-2 overflow-y-scroll flex flex-col">
            <!-- Sidebar content here -->
            <div class="divider m-0 mb-2 text-sm text-gray-500">General</div>
            <li>
                <a class="flex gap-2 items-center p-3 {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}"
                    href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <div class="divider m-0 mb-2 text-sm text-gray-500">Data Master</div>
        </ul>
    </div>
</div>

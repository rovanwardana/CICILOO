<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title') | Ciciloo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-[#EEF1F9] px-[20px] py-[24px]">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 h-[57px] bg-[#EEF1F9] flex justify-between items-center px-[20px] z-20">
        <!-- Logo -->
        <div class="flex items-center gap-2 text-[#071739]">
            <img src="/assets/image/logo.svg" alt="logo" class="w-[117px] h-[52px] object-contain">
            <span class="text-xl font-bold"></span>
        </div>

        <!-- Search & Icons -->
        <div class="flex items-center gap-4">
            <input type="text" placeholder="Search..."
                class="w-[200px] px-[16px] py-[8px] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#4B6382] text-sm bg-[#D7D9E1]" />
            <img src="/assets/icons/notifications.svg" alt="Notifications" class="w-[24px] h-[24px] cursor-pointer">
            <a href="{{ route('profile') }}">
                <img src="/assets/icons/user.svg" alt="User" class="w-[24px] h-[24px] cursor-pointer">
            </a>
            <img src="/assets/icons/log-out.svg" alt="Logout" class="w-[24px] h-[24px] cursor-pointer">
        </div>
    </header>

    <!-- Main Layout -->
    <div class="flex gap-[36px]">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed top-[64px] left-0 w-[220px] h-[calc(100vh-64px-24px)] bg-[#071739] rounded-lg p-4 flex flex-col justify-between overflow-hidden z-10 transition-all duration-300 ml-[20px]">
            <div class="flex flex-col gap-4">
                <!-- Toggle Sidebar -->
                <div class="flex justify-end">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-6 h-6 text-white lucide lucide-panel-right-open-icon lucide-panel-right-open">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <path d="M15 3v18" />
                            <path d="m10 15-3-3 3-3" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                @php
                    $menus = [
                        [
                            'route' => 'dashboard',
                            'label' => 'Dashboard',
                            'icon' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',
                        ],
                        [
                            'route' => 'transaction.index',
                            'label' => 'Transaction',
                            'icon' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>',
                        ],
                        [
                            'route' => 'bills.create',
                            'label' => 'New Bill',
                            'icon' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
                        ],
                        [
                            'route' => 'friends.index',
                            'label' => 'Friends',
                            'icon' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 2v2"/><path d="M17.915 22a6 6 0 0 0-12 0"/><path d="M8 2v2"/><circle cx="12" cy="12" r="4"/><rect x="3" y="4" width="18" height="18" rx="2"/></svg>',
                        ],
                        [
                            'route' => 'settings',
                            'label' => 'Settings',
                            'icon' =>
                                '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>',
                        ],
                    ];
                @endphp

                <!-- Navigation Menu -->
                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                        class="flex items-center gap-2 px-4 h-[52px] rounded-[9px] transition-all duration-200 {{ request()->routeIs($menu['route']) ? 'bg-[#A4B5C4] text-[#071739]' : 'text-white hover:bg-[#2a3950]' }}">
                        {!! $menu['icon'] !!}
                        <span class="label">{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Help & Logout -->

            <div class="flex flex-col gap-4">
                @include('logout_popup')
                <a href="#"
                    class="menu-item flex items-center gap-2 px-4 h-[52px] rounded-[9px] transition-all duration-200 
                        {{ request()->routeIs('help') ? 'bg-[#A4B5C4] text-[#071739]' : 'text-white hover:bg-[#2a3950]' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-circle-help-icon lucide-circle-help">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <path d="M12 17h.01" />
                    </svg>
                    <span class="label">Help</span>
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 h-[52px] rounded-[9px] text-white hover:bg-[#2a3950]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m16 17 5-5-5-5" />
                        <path d="M21 12H9" />
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    </svg>
                    <span class="label">Log out</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 ml-[240px] p-6 mt-[15px] transition-all duration-300">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>

</html>

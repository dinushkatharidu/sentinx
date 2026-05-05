<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SentinX - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#0b1120] text-gray-100 font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#111827] border-r border-gray-800 flex flex-col transition-all duration-300">
        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-black text-blue-500 tracking-tighter italic">SENTINX</h1>
            <p class="text-[10px] font-mono text-emerald-500 uppercase tracking-widest mt-1">Intelligence Protocol</p>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-600/10 hover:text-blue-500 transition {{ request()->routeIs('dashboard') ? 'bg-blue-600/10 text-blue-500 border-l-4 border-blue-500' : 'text-gray-400' }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span class="text-sm font-bold uppercase tracking-wider">Command Center</span>
            </a>

            <a href="{{ route('targets.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-600/10 hover:text-blue-500 transition {{ request()->routeIs('targets.index') ? 'bg-blue-600/10 text-blue-500 border-l-4 border-blue-500' : 'text-gray-400' }}">
                <i class="fa-solid fa-users-viewfinder"></i>
                <span class="text-sm font-bold uppercase tracking-wider">All Targets</span>
            </a>

            <a href="{{ route('targets.create') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-600/10 hover:text-blue-500 transition {{ request()->routeIs('targets.create') ? 'bg-blue-600/10 text-blue-500 border-l-4 border-blue-500' : 'text-gray-400' }}">
                <i class="fa-solid fa-user-plus"></i>
                <span class="text-sm font-bold uppercase tracking-wider">New Operation</span>
            </a>

            <div class="pt-4 pb-2 text-[10px] font-bold text-gray-600 uppercase tracking-[0.2em] px-3">System Assets</div>

            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-600/10 hover:text-purple-500 transition text-gray-400">
                <i class="fa-solid fa-vault"></i>
                <span class="text-sm font-bold uppercase tracking-wider">Evidence Vault</span>
            </a>
        </nav>

        <div class="p-6 border-t border-gray-800 bg-[#0d1422]">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center font-bold text-xs uppercase">DT</div>
                <div>
                    <p class="text-[10px] font-bold text-white uppercase">D. Tharidu</p>
                    <p class="text-[9px] text-emerald-500 font-mono italic">Lead Engineer</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Nav -->
        <header class="h-16 border-b border-gray-800 bg-[#0b1120] flex items-center justify-between px-8">
            <div class="text-xs font-mono text-gray-500">
                <span class="text-blue-500 italic">SYSTEM_STATUS:</span> ONLINE | <span class="text-emerald-500 font-bold uppercase tracking-widest">Secure Connection</span>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-white transition"><i class="fa-solid fa-bell text-sm"></i></button>
                <div class="h-6 w-[1px] bg-gray-800"></div>
                <button class="text-xs font-bold uppercase tracking-widest text-red-500 hover:text-red-400 transition">Logout</button>
            </div>
        </header>

        <!-- Content Area -->
        <section class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            @yield('content')
        </section>
    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #0b1120; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 10px; }
    </style>
</body>
</html>

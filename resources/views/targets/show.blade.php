@extends('layouts.app')

@section('title', 'Intelligence Report - ' . $target->name)

@section('content')
    <div class="max-w-6xl mx-auto">

        <!-- TOP HEADER: Identity & Core Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 border-b border-gray-800 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-black text-blue-500 tracking-tighter uppercase italic">Intelligence Report</h1>
                <p class="text-xs font-mono text-gray-500 mt-1">
                    Target ID: <span class="text-blue-300 font-bold">#SX-00{{ $target->id }}</span> |
                    Status: <span class="text-yellow-500 font-bold uppercase tracking-widest">{{ $target->status }}</span>
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('targets.edit', $target->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-xs font-bold uppercase transition">Edit
                    Target</a>
                <a href="{{ route('targets.report', $target->id) }}" target="_blank"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded text-xs font-bold uppercase transition">Generate
                    Report</a>
                <a href="{{ route('targets.index') }}"
                    class="text-gray-500 hover:text-white px-4 py-2 text-xs font-bold transition uppercase">← Back to
                    Records</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT COLUMN: Profile Information -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-2xl relative overflow-hidden">
                    <h3 class="text-blue-400 text-[10px] font-bold uppercase mb-4 tracking-[0.2em]">Target Profile</h3>

                    <div class="relative group">
                        @if ($target->image)
                            <img src="{{ asset('storage/' . $target->image) }}"
                                class="w-full h-80 object-cover rounded border border-gray-700 filter grayscale contrast-125 transition group-hover:grayscale-0">
                            <div
                                class="absolute bottom-2 right-2 bg-blue-600 text-[9px] px-2 py-1 rounded font-bold uppercase shadow-lg">
                                Verified Evidence</div>
                        @else
                            <div
                                class="w-full h-80 bg-gray-800 flex items-center justify-center rounded border border-gray-700 font-mono text-[10px] text-gray-600 text-center px-4 uppercase italic">
                                No Visual Evidence Available</div>
                        @endif
                    </div>

                    <div class="mt-6 space-y-4 font-mono">
                        <div>
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Full Name</p>
                            <p class="text-lg font-bold text-white tracking-tight">{{ $target->name }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Handle / Username
                            </p>
                            <p class="text-blue-400 text-sm italic">@ {{ $target->username ?? 'Unknown' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Primary Email</p>
                            <p class="text-gray-300 text-xs truncate italic">{{ $target->email ?? 'Not Provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Intelligence & Logs -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Automated Intelligence Gathering -->
                <div class="bg-[#111827] p-6 rounded-lg border border-gray-800">
                    <h3 class="text-emerald-500 text-[10px] font-bold uppercase mb-4 tracking-[0.2em]">Automated
                        Intelligence Gathering</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2 text-xs">
                        <a href="https://www.google.com/search?q={{ urlencode($target->name) }}" target="_blank"
                            class="flex items-center justify-between p-4 bg-[#0b1120] hover:bg-[#1f2937] rounded-lg border border-gray-800 transition">
                            <span class="font-mono text-gray-300 italic">Google Search Analysis</span>
                            <span class="text-[9px] bg-blue-600 px-2 py-1 rounded font-bold uppercase">Scan</span>
                        </a>
                        <a href="https://www.linkedin.com/search/results/all/?keywords={{ urlencode($target->name) }}"
                            target="_blank"
                            class="flex items-center justify-between p-4 bg-[#0b1120] hover:bg-[#1f2937] rounded-lg border border-gray-800 transition tracking-tighter">
                            <span class="font-mono text-gray-300 italic">LinkedIn Profile Finder</span>
                            <span class="text-[9px] bg-blue-600 px-2 py-1 rounded font-bold uppercase">Identify</span>
                        </a>
                        @if ($target->username)
                            <a href="https://github.com/{{ $target->username }}" target="_blank"
                                class="flex items-center justify-between p-4 bg-[#0b1120] hover:bg-[#1f2937] rounded-lg border border-gray-800 transition">
                                <span class="font-mono text-gray-300 italic">GitHub Code Recon</span>
                                <span
                                    class="text-[9px] bg-purple-600 px-2 py-1 rounded font-bold uppercase">Recon</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Investigation Log -->
                <div class="bg-[#111827] p-6 rounded-lg border border-gray-800">
                    <h3 class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-[0.2em]">Investigation Log
                    </h3>

                    <form action="{{ route('activities.store', $target->id) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="note" placeholder="Log a new finding..."
                                class="flex-1 bg-[#0b1120] border border-gray-800 rounded px-4 py-2 text-xs focus:outline-none focus:border-yellow-500 transition text-white placeholder-gray-600"
                                required>
                            <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded text-xs font-black uppercase tracking-widest transition">Log</button>
                        </div>
                    </form>

                    <div class="space-y-4 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse ($target->activities->reverse() as $activity)
                            <div class="p-4 bg-[#0b1120]/60 border-l-4 border-yellow-600 rounded-r-lg">
                                <p class="text-xs text-gray-200 leading-relaxed font-mono tracking-tight">
                                    {{ $activity->note }}</p>
                                <span
                                    class="text-[9px] text-gray-600 mt-2 block uppercase font-bold italic tracking-tighter">Reported
                                    {{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-center text-gray-600 py-10 italic uppercase text-[10px] tracking-widest">No
                                activities logged for this target yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Evidence Vault (Individual File Logic Preserved) -->
                <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-2xl">
                    <h3 class="text-blue-400 text-[10px] font-bold uppercase mb-6 tracking-[0.2em] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Evidence Vault
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @forelse($target->evidences as $evidence)
                            <div
                                class="bg-[#0b1120] rounded border border-gray-800 overflow-hidden hover:border-blue-500/40 transition-all duration-300 group relative">

                                <!-- File Preview/Icon Area -->
                                <div
                                    class="h-28 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-all">
                                    <svg class="w-10 h-10 {{ strtolower($evidence->file_type) == 'pdf' ? 'text-red-500/70' : 'text-blue-500/70' }} group-hover:scale-110 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>

                                <!-- Info Strip -->
                                <div class="p-2 bg-[#111827]">
                                    <p class="text-[9px] font-mono text-gray-400 truncate text-center"
                                        title="{{ $evidence->original_name }}">
                                        {{ $evidence->original_name }}
                                    </p>
                                </div>

                                <!-- SLIDE-UP MODERN ACTION BAR (User Requested - Kept Exactly Same) -->
                                <div
                                    class="absolute inset-x-0 bottom-0 flex border-t border-gray-800 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                                    <!-- DOWNLOAD -->
                                    <a href="{{ asset('storage/' . $evidence->file_path) }}" target="_blank"
                                        class="flex-1 bg-gray-900/90 hover:bg-blue-600 hover:text-white py-2 text-center text-[9px] font-black uppercase tracking-tighter transition-all text-blue-400 border-r border-gray-800">
                                        Acquire
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('evidence.destroy', $evidence->id) }}" method="POST"
                                        class="flex-1" onsubmit="return confirm('ERASE EVIDENCE?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full bg-gray-900/90 hover:bg-red-700 hover:text-white py-2 text-center text-[9px] font-black uppercase tracking-tighter transition-all text-red-500">
                                            Erase
                                        </button>
                                    </form>
                                </div>

                                <!-- File Extension Badge -->
                                <div
                                    class="absolute top-2 left-2 bg-gray-900/80 text-[8px] px-1.5 py-0.5 rounded border border-gray-700 font-mono uppercase text-gray-400">
                                    {{ $evidence->file_type }}
                                </div>
                            </div>
                        @empty
                            <div
                                class="col-span-full py-12 text-center border-2 border-dashed border-gray-800 rounded-lg">
                                <p class="text-[10px] text-gray-600 uppercase tracking-widest italic">The vault
                                    contains no visual evidence records.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

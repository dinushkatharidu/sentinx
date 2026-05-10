@extends('layouts.app')

@section('title', 'Command Center')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-blue-500 tracking-tighter uppercase italic">Command Center</h1>
            <p class="text-xs font-mono text-emerald-500 mt-1 uppercase tracking-widest animate-pulse">System Online | Intelligence Protocol Active</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('reports.global-master') }}" target="_blank"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded text-xs font-bold uppercase tracking-widest transition shadow-lg shadow-emerald-900/20 flex items-center group">
                <svg class="w-3.5 h-3.5 mr-2 font-black group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Master Report
            </a>

            <a href="{{ route('targets.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-xs font-bold uppercase tracking-widest transition shadow-lg shadow-blue-900/20">
               New Operation
            </a>

            <a href="{{ route('targets.index') }}"
               class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-2 rounded text-xs font-bold uppercase tracking-widest transition border border-gray-700">
               Target Records
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-blue-500">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 00-7 7v1h11v-1a7 7 0 00-7-7z"></path></svg>
            </div>
            <h3 class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Total Targets</h3>
            <p class="text-4xl font-black text-white font-mono">{{ $stats['total_targets'] }}</p>
        </div>

        <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl relative overflow-hidden group border-l-4 border-l-yellow-600">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-yellow-500">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            </div>
            <h3 class="text-yellow-500/50 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Active Cases</h3>
            <p class="text-4xl font-black text-white font-mono">{{ $stats['active_cases'] }}</p>
        </div>

        <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl relative overflow-hidden group border-l-4 border-l-emerald-600">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-emerald-500">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <h3 class="text-emerald-500/50 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Closed Protocols</h3>
            <p class="text-4xl font-black text-white font-mono">{{ $stats['closed_cases'] }}</p>
        </div>

        <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl relative overflow-hidden group border-l-4 border-l-blue-600">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition text-blue-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-blue-500/50 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Evidence Vault</h3>
            <p class="text-4xl font-black text-white font-mono">{{ $stats['total_evidence'] ?? 0 }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-2xl overflow-hidden">
            <h3 class="text-blue-400 text-[10px] font-bold uppercase mb-6 tracking-[0.2em] flex items-center">
                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                Live Intelligence Feed
            </h3>
            <div class="space-y-4 max-h-[450px] overflow-y-auto pr-2 custom-scrollbar">
                @forelse($recent_activities as $activity)
                    <div class="bg-[#0b1120] p-4 rounded border border-gray-800 flex justify-between items-center group hover:border-blue-500/30 transition">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded overflow-hidden border border-gray-700 bg-gray-800 flex-shrink-0">
                                @if ($activity->target->image)
                                    <img src="{{ asset('storage/' . $activity->target->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-gray-300 font-mono tracking-tighter leading-tight">{{ $activity->note }}</p>
                                <p class="text-[9px] text-gray-600 uppercase mt-1">
                                    TARGET: <a href="{{ route('targets.show', $activity->target->id) }}" class="text-blue-500 hover:underline font-bold">
                                        #{{ $activity->target->case_id ?? sprintf('SX-%03d', $activity->target->id) }}
                                    </a>
                                    | <span class="italic">{{ $activity->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 opacity-0 group-hover:opacity-100 transition">
                            <a href="{{ route('targets.show', $activity->target->id) }}" class="text-gray-500 hover:text-blue-500 transition" title="View Profile">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-[#0b1120] rounded border border-dashed border-gray-800">
                        <p class="text-[10px] text-gray-600 italic uppercase tracking-[0.3em]">No live signals detected</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl">
                <h3 class="text-emerald-500 text-[10px] font-bold uppercase mb-6 tracking-[0.2em]">Quick Operations</h3>
                <div class="space-y-3">
                    <button onclick="runOperation('System Integrity Scan')" class="w-full bg-[#0b1120] border border-gray-800 p-3 rounded text-left text-[10px] font-mono hover:border-emerald-500/50 hover:bg-[#111827] transition flex items-center group">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-3 group-hover:animate-ping"></span>
                        System Integrity Scan
                    </button>
                    <div class="p-3 border border-dashed border-gray-800 rounded opacity-50">
                        <p class="text-[8px] uppercase tracking-widest text-gray-500">Global Master Report available in Header</p>
                    </div>
                    <button onclick="runOperation('Vault Synchronization')" class="w-full bg-[#0b1120] border border-gray-800 p-3 rounded text-left text-[10px] font-mono hover:border-purple-500/50 hover:bg-[#111827] transition flex items-center group">
                        <span class="w-1.5 h-1.5 bg-purple-500 rounded-full mr-3 group-hover:animate-ping"></span>
                        Sync Global Evidence Vault
                    </button>
                </div>
            </div>

            <div class="bg-[#111827] p-6 rounded-lg border border-gray-800 shadow-xl border-t-2 border-t-blue-500">
                <h3 class="text-blue-500 text-[10px] font-bold uppercase mb-4 tracking-[0.2em]">Developer Status</h3>
                <div class="font-mono text-[10px] space-y-2">
                    <div class="flex justify-between border-b border-gray-800/50 pb-1 text-[9px] uppercase tracking-tighter">
                        <span class="text-gray-600">Lead Engineer</span>
                        <span class="text-gray-300 font-bold">D. Tharidu</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800/50 pb-1 text-[9px] uppercase tracking-tighter">
                        <span class="text-gray-600">Version control</span>
                        <span class="text-gray-300 font-bold">1.2.5-Stable</span>
                    </div>
                    <div class="flex justify-between text-[9px] uppercase tracking-tighter">
                        <span class="text-gray-600">Environment</span>
                        <span class="text-emerald-500 font-black">Secure Production</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function runOperation(opName) {
            console.log("SENTINX: Initiating " + opName);
            alert("COMMAND INITIATED: " + opName + "\n\nAccessing encrypted databases... Secure connection established.");
        }
    </script>
@endsection

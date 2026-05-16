@extends('layouts.app')

@section('title', 'Investigation Targets')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-black text-blue-500 tracking-tighter uppercase italic">Investigation Targets</h2>
                <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mt-1">Active Field Records</p>
            </div>
            <a href="{{ route('targets.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-xs font-bold uppercase tracking-widest transition shadow-lg shadow-blue-900/20">
                + New Target
            </a>
        </div>

        <div class="mb-10 max-w-2xl">
            <form action="{{ route('targets.search') }}" method="GET" class="flex gap-3 items-center group">
                <div class="relative flex-1">
                    <span
                        class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa-solid fa-terminal text-sm"></i>
                    </span>

                    <input type="text" name="query" required value="{{ request('query') }}"
                        class="block w-full bg-[#111827]/80 border border-gray-800 rounded-lg py-4 pl-12 pr-4 text-[11px] text-gray-300 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/20 transition-all font-mono placeholder-gray-700 uppercase tracking-[0.15em] backdrop-blur-sm shadow-xl"
                        placeholder="INITIATE_SEARCH: ENTER TARGET_NAME OR CASE_SERIAL_ID...">
                </div>

                @if (request('query'))
                    <a href="{{ route('targets.index') }}"
                        class="bg-red-950/30 hover:bg-red-950/50 text-red-500 border border-red-900/50 px-5 py-4 rounded-lg text-[10px] font-black uppercase tracking-[0.15em] transition-all flex items-center h-full shadow-lg shadow-red-950/20 active:scale-95 animate-fade-in">
                        <i class="fa-solid fa-rotate-left mr-2"></i> Reset_System
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-[#111827] rounded-lg overflow-hidden border border-gray-800 shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead class="bg-[#0b1120] border-b border-gray-800">
                    <tr>
                        <th class="p-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Case ID</th>
                        <th class="p-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Name</th>
                        <th class="p-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Username</th>
                        <th class="p-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="p-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest text-right">Added Date
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach ($targets as $target)
                        <tr class="hover:bg-blue-600/5 transition group">
                            <td class="p-4 font-mono text-blue-400 text-xs font-bold">
                                #SX-00{{ $target->id }}
                            </td>
                            <td class="p-4">
                                <a href="{{ route('targets.show', $target->id) }}"
                                    class="text-gray-200 group-hover:text-blue-400 font-medium transition">
                                    {{ $target->name }}
                                </a>
                            </td>
                            <td class="p-4 text-xs text-gray-500 italic">{{ $target->username ?? 'N/A' }}</td>
                            <td class="p-4 text-[10px]">
                                @if ($target->status == 'active')
                                    <span
                                        class="bg-red-900/30 text-red-500 px-2 py-1 rounded font-black uppercase border border-red-900/50">●
                                        Active</span>
                                @elseif($target->status == 'pending')
                                    <span
                                        class="bg-yellow-900/30 text-yellow-500 px-2 py-1 rounded font-black uppercase border border-yellow-900/50">○
                                        Pending</span>
                                @else
                                    <span
                                        class="bg-emerald-900/30 text-emerald-500 px-2 py-1 rounded font-black uppercase border border-emerald-900/50">✓
                                        Closed</span>
                                @endif
                            </td>
                            <td class="p-4 text-xs text-gray-600 font-mono text-right">
                                {{ $target->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

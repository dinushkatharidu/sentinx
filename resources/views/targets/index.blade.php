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

        <div class="hidden lg:block ml-4 flex-1 max-w-xs">
            <form action="{{ route('targets.search') }}" method="GET" class="relative group">
                <span
                    class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-hover:text-blue-500 transition">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" name="query"
                    class="block w-full bg-[#0d1422] border border-gray-800 rounded-full py-1.5 pl-10 pr-3 text-xs text-gray-300 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/20 transition-all font-mono"
                    placeholder="SEARCH TARGET OR CASE_ID...">
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

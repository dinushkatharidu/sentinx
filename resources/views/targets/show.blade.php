<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelligence Report - {{ $target->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-6 md:p-10">
    <div class="max-w-6xl mx-auto">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 border-b border-gray-700 pb-6 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-blue-500 uppercase tracking-widest">Intelligence Report</h1>
                <p class="text-gray-400 mt-1">
                    Target ID: <span class="text-gray-200 font-mono">#SX-00{{ $target->id }}</span> |
                    Status: <span class="text-yellow-500 uppercase font-bold">{{ $target->status }}</span>
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('targets.edit', $target->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition duration-200 font-semibold shadow-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Target
                </a>
                <a href="{{ route('targets.report', $target->id) }}" target="_blank"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-md transition font-bold flex items-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    GENERATE REPORT
                </a>

                <a href="{{ route('targets.index') }}"
                    class="text-gray-400 hover:text-white border border-gray-600 px-4 py-2 rounded-md transition duration-200 flex items-center">
                    ← Back to Records
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="space-y-8">
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl">
                    <h3
                        class="text-xl font-bold mb-4 text-blue-400 border-b border-gray-700 pb-2 uppercase tracking-tight">
                        Target Profile</h3>

                    <div class="mb-6">
                        @if ($target->image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $target->image) }}" alt="Evidence"
                                    class="w-full h-64 object-cover rounded-lg border-2 border-gray-700 shadow-2xl transition duration-300 group-hover:border-blue-500">
                                <div
                                    class="absolute bottom-2 right-2 bg-blue-600 text-[10px] px-2 py-1 rounded font-bold uppercase">
                                    Verified Evidence
                                </div>
                            </div>
                        @else
                            <div
                                class="w-full h-48 bg-gray-900 flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-700 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs italic uppercase tracking-widest">No Visual Evidence</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <p>
                            <span class="text-gray-500 block text-[10px] uppercase tracking-widest font-bold">Full
                                Name</span>
                            <span class="text-lg font-semibold text-white">{{ $target->name }}</span>
                        </p>
                        <p>
                            <span class="text-gray-500 block text-[10px] uppercase tracking-widest font-bold">Handle /
                                Username</span>
                            <span class="text-lg text-blue-300">{{ $target->username ?? 'Unknown' }}</span>
                        </p>
                        <p>
                            <span class="text-gray-500 block text-[10px] uppercase tracking-widest font-bold">Primary
                                Email</span>
                            <span class="text-md text-blue-100 italic">{{ $target->email ?? 'Not Provided' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-gray-800 p-6 rounded-lg border border-blue-900/30 shadow-xl">
                    <h3
                        class="text-xl font-bold mb-4 text-green-400 border-b border-gray-700 pb-2 uppercase tracking-tight">
                        Automated Intelligence Gathering</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <a href="https://www.google.com/search?q={{ urlencode($target->name) }}" target="_blank"
                            class="flex items-center justify-between p-4 bg-gray-900/50 hover:bg-blue-900/40 rounded-lg transition border border-gray-700">
                            <span class="font-medium">Google Search Analysis</span>
                            <span class="text-[10px] bg-blue-600 px-2 py-1 rounded font-bold">SCAN</span>
                        </a>

                        <a href="https://www.linkedin.com/search/results/all/?keywords={{ urlencode($target->name) }}"
                            target="_blank"
                            class="flex items-center justify-between p-4 bg-gray-900/50 hover:bg-blue-900/40 rounded-lg transition border border-gray-700">
                            <span class="font-medium">LinkedIn Profile Finder</span>
                            <span class="text-[10px] bg-blue-600 px-2 py-1 rounded font-bold">IDENTIFY</span>
                        </a>

                        @if ($target->username)
                            <a href="https://github.com/{{ $target->username }}" target="_blank"
                                class="flex items-center justify-between p-4 bg-gray-900/50 hover:bg-blue-900/40 rounded-lg transition border border-gray-700">
                                <span class="font-medium">GitHub Code Recon</span>
                                <span class="text-[10px] bg-purple-600 px-2 py-1 rounded font-bold">RECON</span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl">
                    <h3
                        class="text-xl font-bold mb-4 text-yellow-500 border-b border-gray-700 pb-2 uppercase tracking-tight">
                        Investigation Log</h3>

                    <form action="{{ route('activities.store', $target->id) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="note" placeholder="Log a new finding..."
                                class="flex-1 p-2 rounded bg-gray-900 border border-gray-700 outline-none focus:border-yellow-500 text-sm transition"
                                required>
                            <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 px-6 py-2 rounded font-bold text-sm transition uppercase">Log</button>
                        </div>
                    </form>

                    <div class="space-y-4 max-h-100 overflow-y-auto pr-2">
                        @forelse ($target->activities->reverse() as $activity)
                            <div class="p-4 bg-gray-900/40 border-l-4 border-yellow-600 rounded-r-lg">
                                <p class="text-gray-200 text-sm leading-relaxed">{{ $activity->note }}</p>
                                <span
                                    class="text-[10px] text-gray-500 mt-2 block uppercase tracking-tighter">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-center text-gray-600 py-10 italic">No activities logged for this target yet.
                            </p>
                        @endforelse
                    </div>
                </div>
                <div class="mt-10 bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl">
                    <h3
                        class="text-xl font-bold mb-6 text-blue-400 border-b border-gray-700 pb-2 uppercase tracking-widest flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Evidence Vault
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @forelse($target->evidences as $evidence)
                            <div
                                class="group relative bg-gray-900 rounded-lg border border-gray-700 overflow-hidden hover:border-blue-500 transition duration-300">

                                <div class="h-32 flex items-center justify-center bg-black/20">
                                    @if (in_array($evidence->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/' . $evidence->file_path) }}"
                                            class="w-full h-full object-cover cursor-pointer"
                                            onclick="window.open(this.src)">
                                    @else
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <span
                                                class="text-[10px] text-gray-400 mt-1 uppercase font-bold">{{ $evidence->file_type }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-2 bg-gray-800 border-t border-gray-700">
                                    <p class="text-[10px] text-gray-300 truncate mb-1"
                                        title="{{ $evidence->original_name }}">
                                        {{ $evidence->original_name }}
                                    </p>
                                    <a href="{{ asset('storage/' . $evidence->file_path) }}" target="_blank"
                                        class="text-[9px] text-blue-400 hover:text-blue-300 font-bold uppercase tracking-tighter flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                    <form action="{{ route('evidence.destroy', $evidence->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-[9px] text-red-500 hover:text-red-400 font-bold uppercase ml-2">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @empty
                            <div
                                class="col-span-full py-10 text-center text-gray-600 border-2 border-dashed border-gray-700 rounded-lg">
                                <p class="italic text-sm">The vault is empty. No files uploaded yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

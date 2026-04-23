<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelligence Report - {{ $target->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-10">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8 border-b border-gray-700 pb-4">
            <div>
                <h1 class="text-4xl font-bold text-blue-500 uppercase tracking-widest">Intelligence Report</h1>
                <p class="text-gray-400">Target ID: #SX-00{{ $target->id }} | Status: <span
                        class="text-yellow-500 uppercase">{{ $target->status }}</span></p>
            </div>
            <a href="{{ route('targets.index') }}"
                class="text-gray-400 hover:text-white border border-gray-600 px-4 py-2 rounded">← Back to Records</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl">
                <h3 class="text-xl font-bold mb-4 text-blue-400 border-b border-gray-700 pb-2">Target Profile</h3>
                <div class="space-y-4">
                    <p><span class="text-gray-500 block text-xs">NAME</span> <span
                            class="text-lg font-semibold">{{ $target->name }}</span></p>
                    <p><span class="text-gray-500 block text-xs">HANDLE</span> <span
                            class="text-lg">{{ $target->username ?? 'Unknown' }}</span></p>
                    <p><span class="text-gray-500 block text-xs">EMAIL</span> <span
                            class="text-md text-blue-300">{{ $target->email ?? 'Not Provided' }}</span></p>
                </div>
            </div>

            <div class="md:col-span-2 bg-gray-800 p-6 rounded-lg border border-blue-900 shadow-2xl">
                <h3 class="text-xl font-bold mb-4 text-green-400 border-b border-gray-700 pb-2">Automated Intelligence
                    Gathering</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="https://www.google.com/search?q={{ urlencode($target->name) }}" target="_blank"
                        class="flex items-center justify-between p-4 bg-gray-700 hover:bg-blue-900 rounded transition border border-gray-600">
                        <span>Google Search Analysis</span>
                        <span class="text-xs bg-blue-600 px-2 py-1 rounded">SCAN</span>
                    </a>

                    <a href="https://www.linkedin.com/search/results/all/?keywords={{ urlencode($target->name) }}"
                        target="_blank"
                        class="flex items-center justify-between p-4 bg-gray-700 hover:bg-blue-900 rounded transition border border-gray-600">
                        <span>LinkedIn Profile Finder</span>
                        <span class="text-xs bg-blue-600 px-2 py-1 rounded">IDENTIFY</span>
                    </a>

                    @if ($target->username)
                        <a href="https://github.com/{{ $target->username }}" target="_blank"
                            class="flex items-center justify-between p-4 bg-gray-700 hover:bg-blue-900 rounded transition border border-gray-600">
                            <span>GitHub Code Analysis</span>
                            <span class="text-xs bg-blue-600 px-2 py-1 rounded">RECON</span>
                        </a>
                    @endif
                </div>

            </div>
            <div class="mt-10 bg-gray-800 p-6 rounded-lg border border-gray-700 shadow-xl">
                <h3 class="text-xl font-bold mb-4 text-yellow-500 border-b border-gray-700 pb-2">Investigation Log</h3>

                <form action="{{ route('activities.store', $target->id) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="flex gap-2">
                        <input type="text" name="note" placeholder="Log a new finding..."
                            class="flex-1 p-2 rounded bg-gray-700 border border-gray-600 outline-none focus:border-yellow-500"
                            required>
                        <button type="submit"
                            class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 rounded font-bold">LOG</button>
                    </div>
                </form>

                <div class="space-y-4">
                    @foreach ($target->activities->reverse() as $activity)
                        <div class="p-3 bg-gray-750 border-l-4 border-yellow-600 rounded">
                            <p class="text-gray-300">{{ $activity->note }}</p>
                            <span class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target List - SentinX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-10">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-blue-400">Investigation Targets</h2>
            <a href="{{ route('targets.create') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">+ New
                Target</a>
        </div>

        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
            <table class="w-full text-left">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="p-4">Name</th>
                        <th class="p-4">Username</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Added Date</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($targets as $target)
                        <tr class="border-b border-gray-700 hover:bg-gray-750">
                            <td class="p-4">
                                <a href="{{ route('targets.show', $target->id) }}"
                                    class="text-blue-400 hover:underline font-medium">
                                    {{ $target->name }}
                                </a>
                            </td>
                            <td class="p-4">{{ $target->username ?? 'N/A' }}</td>
                            <td class="p-4">
                                <span class="bg-yellow-900 text-yellow-300 px-2 py-1 rounded text-xs uppercase">
                                    {{ $target->status }}
                                </span>
                            </td>
                            <td class="p-4">{{ $target->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Target - {{ $target->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-10">
    <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-lg shadow-xl border border-gray-700">
        <h2 class="text-2xl font-bold mb-6 text-blue-400 border-b border-gray-700 pb-2">Edit Target: {{ $target->name }}</h2>

        <form action="{{ route('targets.update', $target->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Name</label>
                <input type="text" name="name" value="{{ $target->name }}" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-blue-500 outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-blue-500 outline-none text-white">
                    <option value="pending" {{ $target->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $target->status == 'active' ? 'selected' : '' }}>Active Investigation</option>
                    <option value="closed" {{ $target->status == 'closed' ? 'selected' : '' }}>Closed / Archived</option>
                </select>
            </div>

            <div class="flex justify-between mt-8 border-t border-gray-700 pt-6">
                <a href="{{ route('targets.show', $target->id) }}" class="text-gray-400 hover:text-white pt-2">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded font-bold transition">Update Target</button>
            </div>
        </form>

        <div class="mt-12 border-t border-red-900 pt-6">
            <h3 class="text-red-500 font-bold mb-2">Danger Zone</h3>
            <p class="text-gray-500 text-xs mb-4">Once you delete a target, there is no going back. Please be certain.</p>
            <form action="{{ route('targets.destroy', $target->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-900 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition font-semibold">
                    Delete Target Permanently
                </button>
            </form>
        </div>
    </div>
</body>
</html>

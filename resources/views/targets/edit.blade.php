

<body class="bg-gray-900 text-white p-10">
    <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-lg shadow-xl border border-gray-700">
        <h2 class="text-2xl font-bold mb-6 text-blue-400">Edit Target: {{ $target->name }}</h2>

        <form action="{{ route('targets.update', $target->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
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

            <div class="flex justify-between mt-6">
                <a href="{{ route('targets.show', $target->id) }}" class="text-gray-400 hover:text-white pt-2">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded font-bold">Update Target</button>
            </div>
        </form>
    </div>
</body>

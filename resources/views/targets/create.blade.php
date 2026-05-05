@extends('layouts.app')

@section('title', 'Add New Target')

@section('content')
    {{-- ඔයා දීපු Form එකේ පෙනුම සහ Details ඒ විදිහටම මෙතන තියෙනවා --}}
    <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg border border-blur-500">
        <h2 class="text-2xl font-bold mb-6 text-blue-400">🕵️ Add New Investigation Target</h2>

        <form action="{{ route('targets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-2">Full Name</label>
                <input type="text" name="name"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-blue-500 outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-2">Username / Handle</label>
                <input type="text" name="username"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-2">Email Address</label>
                <input type="email" name="email"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Evidence Image (Optional)</label>
                <input type="file" name="image"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 outline-none text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            </div>
            <div class="mb-4 bg-gray-800 p-4 rounded-lg border border-gray-700">
                <label class="block text-blue-400 font-bold mb-2 uppercase text-xs tracking-widest">
                    Upload Evidence Vault (Images/PDFs)
                </label>

                <input type="file" name="evidences[]" multiple
                    class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">

                <p class="text-[10px] text-gray-500 mt-2 italic">
                    * You can select multiple files (JPG, PNG, PDF) at once.
                </p>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-2">Initial Notes</label>
                <textarea name="notes" class="w-full p-2 rounded bg-gray-700 border border-gray-600 outline-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-3 rounded font-bold transition">Add
                Target</button>

        </form>
    </div>
@endsection

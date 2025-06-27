<x-layouts.app>
<div class="max-w-md mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-left">Edit Buku</h1>
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow border border-gray-200 p-8">
        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Judul</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('title', $book->title) }}" required>
                @error('title')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Penulis</label>
                <input type="text" name="author" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('author', $book->author) }}" required>
                @error('author')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Tahun</label>
                <input type="number" name="year" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('year', $book->year) }}">
                @error('year')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Penerbit</label>
                <input type="text" name="publisher" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('publisher', $book->publisher) }}">
                @error('publisher')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Cover (URL)</label>
                <input type="text" name="cover" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('cover', $book->cover) }}">
                @error('cover')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Stok</label>
                <input type="number" name="stock" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('stock', $book->stock) }}" min="0" required>
                @error('stock')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Genre</label>
                <input type="text" name="genre" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" value="{{ old('genre', $book->genre) }}">
                @error('genre')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800">{{ old('description', $book->description) }}</textarea>
                @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 justify-end">
                <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app> 
<x-layouts.app>
<div class="max-w-md mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6 text-left">Pinjam Buku</h1>
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow border border-gray-200 p-8">
        <form action="{{ route('borrows.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block font-medium mb-1 text-gray-900 dark:text-gray-100">Pilih Buku</label>
                <select name="book_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-900 dark:text-gray-100 bg-white dark:bg-zinc-800" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" @if(old('book_id') == $book->id) selected @endif>
                            {{ $book->title }} (Stok: {{ $book->stock }})
                        </option>
                    @endforeach
                </select>
                @error('book_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 justify-end">
                <a href="{{ route('borrows.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">Pinjam</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app> 
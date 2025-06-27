<x-layouts.app>
<style>
    body {
        background: linear-gradient(135deg, #181c2a 0%, #232946 100%) !important;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }
    .glass-form {
        background: rgba(30,34,54,0.68);
        border-radius: 28px;
        box-shadow: 0 8px 40px 0 rgba(30,34,54,0.22);
        backdrop-filter: blur(14px) saturate(140%);
        border: 1.5px solid rgba(120,130,200,0.13);
        padding: 10px 8px 8px 8px;
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .glass-form:hover {
        box-shadow: 0 16px 48px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.01);
    }
    .glass-input, .glass-textarea {
        background: rgba(49,54,80,0.65);
        border-radius: 12px;
        border: 1.2px solid rgba(120,130,200,0.13);
        color: #fff;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        padding: 10px 16px;
        font-size: 1rem;
        transition: box-shadow 0.18s, border 0.18s, background 0.18s;
    }
    .glass-input:focus, .glass-textarea:focus {
        border-color: #6366f1;
        background: rgba(99,102,241,0.13);
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
        outline: none;
    }
    .glass-label {
        color: #a5b4fc;
        font-weight: 700;
        margin-bottom: 0.3rem;
        display: block;
    }
    .glass-btn {
        background: rgba(49,54,80,0.65);
        border-radius: 14px;
        border: 1.2px solid rgba(120,130,200,0.13);
        color: #fff;
        font-weight: 600;
        transition: background 0.18s, border 0.18s, box-shadow 0.18s;
        box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        padding: 10px 28px;
        font-size: 1rem;
    }
    .glass-btn:hover {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.18);
    }
    .glass-btn.secondary {
        background: rgba(30,34,54,0.68);
        color: #a5b4fc;
    }
    .glass-btn.secondary:hover {
        background: rgba(99,102,241,0.13);
        color: #fff;
    }
    @media (max-width: 700px) {
        .glass-form { border-radius: 14px; padding: 6px 2px 4px 2px; }
        .glass-input, .glass-textarea { font-size: 0.95rem; padding: 8px 8px; }
        .glass-btn { font-size: 0.95rem; padding: 10px 10px; }
    }
    .meteor-bg {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        z-index: 0;
        pointer-events: none;
    }
</style>
<canvas class="meteor-bg"></canvas>
<div class="w-full max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-3xl xl:max-w-4xl mx-auto py-10 px-2 sm:px-4 relative z-10">
    <h1 class="text-2xl font-bold mb-3 text-left text-white">Edit Buku</h1>
    <div class="glass-form">
        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="glass-label">Judul</label>
                <input type="text" name="title" class="w-full glass-input" value="{{ old('title', $book->title) }}" required>
                @error('title')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Penulis</label>
                <input type="text" name="author" class="w-full glass-input" value="{{ old('author', $book->author) }}" required>
                @error('author')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Tahun</label>
                <input type="number" name="year" class="w-full glass-input" value="{{ old('year', $book->year) }}">
                @error('year')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Penerbit</label>
                <input type="text" name="publisher" class="w-full glass-input" value="{{ old('publisher', $book->publisher) }}">
                @error('publisher')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Cover (URL)</label>
                <input type="text" name="cover" class="w-full glass-input" value="{{ old('cover', $book->cover) }}">
                @error('cover')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Stok</label>
                <input type="number" name="stock" class="w-full glass-input" value="{{ old('stock', $book->stock) }}" min="0" required>
                @error('stock')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Genre</label>
                <input type="text" name="genre" class="w-full glass-input" value="{{ old('genre', $book->genre) }}">
                @error('genre')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="glass-label">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full glass-textarea">{{ old('description', $book->description) }}</textarea>
                @error('description')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 justify-end">
                <a href="{{ route('books.index') }}" class="glass-btn secondary">Batal</a>
                <button type="submit" class="glass-btn">Update</button>
            </div>
        </form>
    </div>
</div>
</x-layouts.app> 
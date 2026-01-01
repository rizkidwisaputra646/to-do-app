<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">📝 To-Do App</h1>

        {{-- FORM TAMBAH TUGAS --}}
        <form action="{{ route('tugas.store') }}" method="POST" class="flex gap-2 mb-4">
            @csrf
            <input type="text" name="nama_tugas" placeholder="Masukkan nama tugas..."
                class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Tambah
            </button>
        </form>

        {{-- ERROR VALIDASI --}}
        @error('nama_tugas')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror

        {{-- LIST TUGAS --}}
        <ul class="space-y-2">
            @foreach ($tugas as $item)
                <li class="bg-gray-50 p-3 rounded-lg">

                    {{-- MODE TAMPIL --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            {{-- TOGGLE --}}
                            <form action="{{ route('tugas.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="text-lg">
                                    {{ $item->is_completed ? '☑️' : '⬜' }}
                                </button>
                            </form>

                            <span class="{{ $item->is_completed ? 'line-through text-gray-400' : '' }}">
                                {{ $item->nama_tugas }}
                            </span>
                        </div>

                        <div class="flex gap-2">
                            {{-- TOMBOL EDIT --}}
                            <button
                                onclick="document.getElementById('edit-{{ $item->id }}').classList.toggle('hidden')"
                                class="text-blue-500">
                                ✏️
                            </button>

                            {{-- HAPUS --}}
                            <form action="{{ route('tugas.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">❌</button>
                            </form>
                        </div>
                    </div>

                    {{-- MODE EDIT --}}
                    <form id="edit-{{ $item->id }}" action="{{ route('tugas.update', $item->id) }}" method="POST"
                        class="hidden mt-2 flex gap-2">
                        @csrf
                        @method('PUT')
                        <input type="text" name="nama_tugas" value="{{ $item->nama_tugas }}"
                            class="flex-1 px-2 py-1 border rounded" required>
                        <button class="bg-green-500 text-white px-3 rounded">
                            Simpan
                        </button>
                    </form>

                </li>
            @endforeach
        </ul>

    </div>

</body>

</html>

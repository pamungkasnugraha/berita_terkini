@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-blue-800">LOGIN ADMIN</h2>
                <p class="text-gray-500 text-sm mt-2">Gunakan akun dari DatabaseSeeder</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                    <ul class="list-disc list-inside font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" {{-- Tambahkan text-gray-900 di sini --}}
                        class="w-full border-2 border-gray-100 p-3 rounded-xl text-gray-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all"
                        placeholder="admin@berita.com" required autofocus>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" {{-- Tambahkan text-gray-900 di sini --}}
                        class="w-full border-2 border-gray-100 p-3 rounded-xl text-gray-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all"
                        placeholder="••••••••" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-lg shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Добавить пользователя</h1>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">ФИО <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Дата рождения</label>
                <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Телефон</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Логин <span class="text-red-500">*</span></label>
                <input type="text" name="login" value="{{ old('login') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Пароль <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Подтверждение пароля <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-3" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Фото</label>
                <input type="file" name="photo" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 p-2">
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    Добавить
                </button>
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:underline">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection

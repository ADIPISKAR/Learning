@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Редактировать пользователя</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">ФИО</label>
            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Дата рождения</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Телефон</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Логин</label>
            <input type="text" name="login" value="{{ old('login', $user->login) }}" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Пароль (оставьте пустым, если не меняете)</label>
            <input type="password" name="password" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" class="border rounded w-full p-2">
        </div>

        <div>
            <label class="block font-medium">Фото</label>
            @if($user->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Фото пользователя" class="w-24 h-24 object-cover rounded">
                </div>
            @endif
            <input type="file" name="photo" class="border rounded w-full p-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Сохранить
        </button>
        <a href="{{ route('users.index') }}" class="ml-2 text-gray-600 hover:underline">Отмена</a>
    </form>
</div>
@endsection

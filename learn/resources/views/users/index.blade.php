@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Список пользователей</h1>
        <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition">
            Добавить пользователя
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b">Фото</th>
                    <th class="px-4 py-2 border-b">ФИО</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Телефон</th>
                    <th class="px-4 py-2 border-b">Действия</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">
                            @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">{{ $user->full_name }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->phone }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Редактировать</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($users->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Пользователи отсутствуют</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

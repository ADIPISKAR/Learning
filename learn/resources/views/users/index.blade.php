@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Список пользователей</h1>
        <a href="{{ route('users.create') }}" class="bg-green-500 text-white px-6 py-2 rounded shadow hover:bg-green-600 transition duration-300" style="color: black !important; padding: 6px 12px;">
            Добавить пользователя
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">Фото</th>
                    <th class="px-6 py-3 text-left">ФИО</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Телефон</th>
                    <th class="px-6 py-3 text-left">Действия</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-3">
                            @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" class="w-12 h-12 rounded-full object-cover border">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-full border"></div>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $user->full_name }}</td>
                        <td class="px-6 py-3">{{ $user->email }}</td>
                        <td class="px-6 py-3">{{ $user->phone ?? '-' }}</td>
                        <td class="px-6 py-3 space-x-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Редактировать</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">Пользователи отсутствуют</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

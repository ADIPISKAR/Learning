<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Отображение списка всех пользователей
     */
    public function index()
    {
        // Получаем всех пользователей из базы
        $users = User::all();

        // Передаем пользователей в view users.index
        return view('users.index', compact('users'));
    }

    /**
     * Показ формы для создания нового пользователя
     */
    public function create()
    {
        // Просто возвращаем view с формой создания
        return view('users.create');
    }

    /**
     * Сохранение нового пользователя в базу
     */
    public function store(Request $request)
    {
        // Валидация входных данных
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users', // email должен быть уникальным
            'login' => 'required|string|unique:users', // логин тоже уникальный
            'password' => 'required|string|min:6|confirmed', // проверка подтверждения пароля
            'photo' => 'nullable|image|max:2048', // фото необязательно, макс. 2MB
        ]);

        // Если пользователь загрузил фото, сохраняем в папку storage/app/public/users
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        // Хешируем пароль перед сохранением
        $data['password'] = Hash::make($data['password']);

        // Создаем пользователя
        User::create($data);

        // Редирект на список пользователей с сообщением об успехе
        return redirect()->route('users.index')->with('success', 'Пользователь добавлен');
    }

    /**
     * Показ формы редактирования пользователя
     */
    public function edit(User $user)
    {
        // Передаем конкретного пользователя в view для редактирования
        return view('users.edit', compact('user'));
    }

    /**
     * Обновление данных пользователя
     */
    public function update(Request $request, User $user)
    {
        // Валидация входных данных
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id, // уникальность, кроме текущего пользователя
            'login' => 'required|string|unique:users,login,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // пароль можно не менять
            'photo' => 'nullable|image|max:2048',
        ]);

        // Если загружено новое фото, удаляем старое и сохраняем новое
        if ($request->hasFile('photo')) {
            if ($user->photo) Storage::disk('public')->delete($user->photo);
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        // Если пароль введен, хешируем его
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Если пароль не изменяется, удаляем ключ из данных
            unset($data['password']);
        }

        // Обновляем пользователя
        $user->update($data);

        // Редирект с сообщением об успехе
        return redirect()->route('users.index')->with('success', 'Данные обновлены');
    }

    /**
     * Удаление пользователя
     */
    public function destroy(User $user)
    {
        // Если есть фото, удаляем его из хранилища
        if ($user->photo) Storage::disk('public')->delete($user->photo);

        // Удаляем пользователя из базы
        $user->delete();

        // Редирект с сообщением об успехе
        return redirect()->route('users.index')->with('success', 'Пользователь удален');
    }
}

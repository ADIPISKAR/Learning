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
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Показ формы для создания нового пользователя
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Сохранение нового пользователя в базу
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users_testTask', // новая таблица
            'login' => 'required|string|unique:users_testTask',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Пользователь добавлен');
    }

    /**
     * Показ формы редактирования пользователя
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Обновление данных пользователя
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users_testTask,email,' . $user->id,
            'login' => 'required|string|unique:users_testTask,login,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) Storage::disk('public')->delete($user->photo);
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Данные обновлены');
    }

    /**
     * Удаление пользователя
     */
    public function destroy(User $user)
    {
        if ($user->photo) Storage::disk('public')->delete($user->photo);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Пользователь удален');
    }
}

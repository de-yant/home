<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserSettingController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.settings.users.index', compact('users'));
    }

    public function toggle(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.settings.users.index')->with('success', 'Status pengguna diperbarui.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,pengawas,user',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.settings.users.index')->with('success', 'Role pengguna diperbarui.');
    }

    public function edit(User $user)
    {
        return view('admin.settings.users.edit', compact('user'));
    }

   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,pengawas,user',
        'is_active' => 'required|in:1,0',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->is_active = $request->is_active == "1";
    $user->save();

    return redirect()->route('admin.settings.users.index')->with('success', 'Pengguna berhasil diperbarui.');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.settings.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
};

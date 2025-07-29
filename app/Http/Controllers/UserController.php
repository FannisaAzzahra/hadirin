<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\DataTables\UserDataTable; // Pastikan ini di-import

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(UserDataTable $dataTable) // Gunakan dependency injection untuk UserDataTable
    {
        return $dataTable->render('users.index'); // Render view dengan DataTables
    }

    // ... (metode lainnya seperti create, store, edit, update, destroy, profile, editProfile, updateProfile, updatePassword tetap sama seperti yang kita bahas sebelumnya)
    // PASTIKAN method edit(User $user) dan update(Request $request, User $user) UNTUK ADMIN sudah di-uncomment dan benar.

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified user (for Admin to edit other users).
     */
    public function edit(User $user) // Ini untuk edit user oleh Admin
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage (for Admin to update other users).
     */
    public function update(Request $request, User $user) // Ini untuk update user oleh Admin
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Password opsional saat update
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) { // Jika password diisi, update password
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    // Metode untuk menampilkan profil pengguna yang sedang login
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Metode untuk menampilkan form edit profil pengguna yang sedang login
    public function editProfile() // Nama method diubah agar tidak bentrok
    {
        $user = Auth::user();
        return view('edit-profile', compact('user'));
    }

    // Metode untuk memperbarui profil pengguna yang sedang login
    public function updateProfile(Request $request) // Nama method diubah agar tidak bentrok
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // Metode untuk memperbarui password pengguna yang sedang login
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini tidak cocok.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
    }
}
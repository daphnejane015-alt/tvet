<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of registered users.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $users = User::query()
            ->with(['upTvetApplications', 'upTvetApplication', 'applications.course'])
            ->withCount(['applications', 'upTvetApplications'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role, function ($query, $role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $totalUsers = User::count();
        $studentCount = User::where('role', 'student')->count();
        $adminCount = User::where('role', 'admin')->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'studentCount', 'adminCount', 'search', 'role'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin', 'student'])],
            'password' => ['nullable', 'string', Password::defaults(), 'confirmed'],
        ], [
            'name.required' => 'Nama pengguna diperlukan.',
            'email.required' => 'Emel diperlukan.',
            'email.email' => 'Format emel tidak sah.',
            'email.unique' => 'Emel ini telah digunakan oleh akaun lain.',
            'role.required' => 'Peranan diperlukan.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', "Akaun pengguna {$user->name} berjaya dikemaskini.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Elakkan admin daripada memadam akaun sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak boleh memadam akaun anda sendiri semasa sedang log masuk.');
        }

        $userName = $user->name;

        // Cascade delete or delete user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "Akaun pengguna {$userName} telah berjaya dipadam.");
    }
}

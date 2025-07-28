<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index(Project $project)
    {
        $project->load('members');
        return view('members.index', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika belum ada, buat akun dummy
        if (!$user) {
            $user = User::create([
                'name' => explode('@', $request->email)[0],
                'email' => $request->email,
                'password' => bcrypt(Str::random(12)), // Password random, tidak bisa login sebelum reset
            ]);
        }

        // Cek apakah user sudah jadi anggota proyek
        if ($project->users()->where('user_id', $user->id)->exists()) {
            return redirect()->route('projects.members.index', $project)
                ->with('error', 'Pengguna sudah menjadi anggota proyek.');
        }

        // Tambahkan ke proyek
        $project->users()->attach($user->id);

        return redirect()->route('projects.members.index', $project)
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function destroy(Project $project, User $user)
    {
        $project->members()->detach($user->id);

        return redirect()->back()->with('success', 'Anggota berhasil dihapus dari proyek.');
    }

    public function all()
    {
        $user = auth()->user();
        $projects = $user->projects()->with('members')->get();
        return view('members.all', compact('projects'));
    }
}

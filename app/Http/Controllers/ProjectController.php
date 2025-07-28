<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Carbon\Carbon;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
{
    $user = auth()->user();

    // Proyek yang dimiliki user
    $ownedProjects = $user->projects;

    // Proyek yang diikuti user sebagai anggota
    $memberProjects = $user->memberOf ?? collect();

    // Gabungkan & hapus duplikat
    $projects = $ownedProjects->merge($memberProjects)->unique('id');

    return view('projects.index', [
        'projects' => $projects,
        'filter' => $request->filter ?? '',
    ]);
}
    public function create() {
        return view('projects.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project) {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project) {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek dihapus.');
    }

    public function addMember(Request $request, Project $project) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->id === $project->user_id) {
            return back()->with('error', 'Pemilik proyek sudah otomatis anggota.');
        }

        if ($project->members->contains($user)) {
            return back()->with('error', 'User sudah menjadi anggota.');
        }

        $project->members()->attach($user->id);

        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Project $project) {
        return view('projects.show', compact('project'));
    }
}

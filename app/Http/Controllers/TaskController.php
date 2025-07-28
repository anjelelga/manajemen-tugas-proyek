<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

    class TaskController extends Controller
    {
        public function index(Project $project)
    {
        $tasks = $project->tasks;
        return view('tasks.index', compact('project', 'tasks'));
    }
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project->tasks()->create([
            'name' => $request->name,
            'is_completed' => false,
        ]);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas ditambahkan.');
    }

    public function toggle(Project $project, Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();

        return back()->with('success', 'Status tugas berhasil diubah.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $task->update([
            'name' => $request->name,
        ]);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas berhasil dihapus.');
    }

    public function all()
    {
        $user = auth()->user();
        $projects = $user->projects;
        $tasks = \App\Models\Task::whereIn('project_id', $projects->pluck('id'))->get();

        return view('tasks.all', compact('projects', 'tasks'));
    }
}

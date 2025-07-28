<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Task;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;

    // Redirect ke dashboard
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $projects = $user->projects;
        $projectsCount = $projects->count();

        $tasks = Task::whereIn('project_id', $projects->pluck('id'))->get();
        $tasksCount = $tasks->count();
        $completedTasks = $tasks->where('is_completed', true)->count();

        return view('dashboard', compact('projects', 'projectsCount', 'tasksCount', 'completedTasks'));
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);

    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
    Route::post('/projects/{project}/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('projects.tasks.toggle');



    Route::get('/projects/{project}/members', [MemberController::class, 'index'])->name('projects.members.index');
    Route::post('/projects/{project}/members', [MemberController::class, 'store'])->name('projects.members.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tambah edit dan update
    Route::get('/projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('projects.tasks.edit');
    Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('projects.tasks.update');

    // Tambah hapus
    Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('projects.tasks.destroy');

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::delete('/projects/{project}/members/{user}', [\App\Http\Controllers\MemberController::class, 'destroy'])->name('projects.members.destroy');

    Route::get('/tasks', [TaskController::class, 'all'])->name('tasks.all');

    Route::get('/members', [MemberController::class, 'all'])->name('members.all');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    // Gabungkan proyek milik user + proyek di mana user jadi anggota
    $ownedProjects = $user->projects;
    $memberProjects = $user->memberOf;

    $projects = $ownedProjects->merge($memberProjects)->unique('id');
    $projectsCount = $projects->count();

    $tasks = \App\Models\Task::whereIn('project_id', $projects->pluck('id'))->get();
    $tasksCount = $tasks->count();
    $completedTasks = $tasks->where('is_completed', true)->count();

    return view('dashboard', compact('projects', 'projectsCount', 'tasksCount', 'completedTasks'));
}
}

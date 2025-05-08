<?php

namespace App\Http\Controllers;

//use App\Models\Exam;
//use App\Models\Result;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Solo Estudiante; el middleware ya lo revisa, pero por seguridad podrías:
        if (! $user->hasRole('Estudiante')) {
            abort(403);
        }

        // 1) Exámenes pendientes (los que NO tienen resultado para este usuario)
        $pendingExams = Exam::whereDoesntHave('results', function($q) use ($user) {
            $q->where('student_id', $user->id);
        })->get();

        // 2) Resultados completados
        $completedResults = Result::where('student_id', $user->id)->get();

        // 3) Estadísticas
        $pendingCount   = $pendingExams->count();
        $completedCount = $completedResults->count();
        $averageScore   = $completedCount
            ? round($completedResults->avg('score'), 1)
            : 0;

        // Pasamos todo a la vista
        return view('student.dashboard', [
            'pendingExamsCount'   => $pendingCount,
            'completedExamsCount' => $completedCount,
            'averageScore'        => $averageScore,
            'pendingExams'        => $pendingExams,
        ]);
    }
}

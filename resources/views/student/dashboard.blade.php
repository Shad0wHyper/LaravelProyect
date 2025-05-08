@extends('layouts.app')

@section('title', 'Panel Estudiante')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold mb-6">¡Hola, {{ auth()->user()->name }}!</h1>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-50 p-4 rounded-lg text-center">
                <h2 class="text-lg font-medium text-blue-700">Pendientes</h2>
                <p class="mt-2 text-4xl font-bold text-blue-900">{{ $pendingExamsCount }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg text-center">
                <h2 class="text-lg font-medium text-green-700">Completados</h2>
                <p class="mt-2 text-4xl font-bold text-green-900">{{ $completedExamsCount }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg text-center">
                <h2 class="text-lg font-medium text-yellow-700">Promedio</h2>
                <p class="mt-2 text-4xl font-bold text-yellow-900">{{ $averageScore }}%</p>
            </div>
        </div>

        <!-- Lista de exámenes pendientes -->
        <h2 class="text-2xl font-semibold mb-4">Exámenes Disponibles</h2>
        <ul class="space-y-4">
            @forelse($pendingExams as $exam)
                <li class="bg-gray-50 p-5 rounded-lg flex justify-between items-center shadow-sm">
                    <div>
                        <h3 class="text-xl font-medium">{{ $exam->title }}</h3>
                        <p class="text-gray-500 text-sm">{{ $exam->created_at->format('d M, Y') }}</p>
                    </div>
                    <a href="{{ route('student.exams.take', $exam) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Realizar
                    </a>
                </li>
            @empty
                <li class="text-gray-500">No tienes exámenes pendientes.</li>
            @endforelse
        </ul>
    </div>
@endsection

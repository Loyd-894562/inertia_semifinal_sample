<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index() {
        $students = Student::latest()->get();

        return Inertia::render('Students/Index', ['students' => $students,]);
    }

    public function create() {
        return Inertia::render('Students/Create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
        'student_no' => ['required', 'string', 'max:8'],
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'string', 'max:255'],
        'birthdate' => ['nullable', 'date'],
        ]);

        Student::create($validated);

        return redirect() 
        ->route('students.index')->with('success', 'Student added successfully!');
    }

}

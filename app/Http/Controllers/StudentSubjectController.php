<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentSubjectController extends Controller
{
    // Many to Many
    // Relasi Antara banyak student dan banyak subject
    // banyak student bisa memiliki banyak subject
    public function createStudent(Request $req) {
        $validasi = Validator::make($req->all(), [ //validator Illuminate\Support\Facades\Validator
            'name' => 'required' //validasi name wajib diisi
        ]);

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // Create student
        $student = Student::create([
            'name' => $req->name
        ]);

        return response()->json([
            'message' => 'Student Berhasil Dibuat',
            'data' => $student
        ], 201);
    }

    public function createSubject(Request $req) {
        $validasi = Validator::make($req->all(), [ //validator Illuminate\Support\Facades\Validator
            'name' => 'required' //validasi name wajib diisi
        ]);

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // Create subject 
        $subject = Subject::create([
            'name' => $req->name
        ]);

        // respoonse json 
        return response()->json([
            'message' => 'Subject Berhasil Dibuat',
            'data' => $subject
        ], 201);
    }

    public function enrollStudentSubject(Request $req) {
        $validasi = Validator::make($req->all(), [ //validator Illuminate\Support\Facades\Validator
            'student_id' => 'required|exists:students,id', //validasi student id wajib diisi dan id student exists di students 
            'subject_id' => 'required|exists:subjects,id' //validasi subject id wajib diisi dan id subject exists di subjects 
        ]);

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // Create student subject 
        $studentSubject = StudentSubject::create([
            'subject_id' => $req->subject_id,
            'student_id' => $req->student_id
        ]);

        // response json 
        return response()->json([
            'message' => 'Student Subject Berhasil Dibuat',
            'data' => $studentSubject
        ], 201);
    }

    public function get($id)
    {
        $student = Student::with('subjects')->find($id); // mengambil data student dengan relasi subjects

        return response()->json([
            'message' => 'Student berhasil diambil',
            'data' => $student
        ], 200);
    }
}

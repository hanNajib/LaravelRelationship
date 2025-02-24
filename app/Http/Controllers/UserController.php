<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{

    // One to One relation
    // Relasi Antara User dan Profile
    // Satu User memiliki satu profile dan satu profile memiliki satu user
    public function createUser(Request $req) {
        $validasi = Validator::make($req->all(), [ //validator Illuminate\Support\Facades\Validator
            'name' => 'required' //validasi name wajib diisi
        ]);

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        //create user
        $user = User::create([
            'name' => $req->name
        ]);

        //response json
        return response()->json([
            'message' => 'User Berhasil Dibuat',
            'data' => $user
        ], 201);
    }

    public function createProfile(Request $req) {
        $validasi = Validator::make($req->all(), [
            'user_id' => 'required|exists:users,id', //validasi user id harus diisi dan id itu exists di users
            'bio' => 'required' //validasi bio wajib diisi
        ]); 

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // $profile = User::find($req->user_id)->profile()->create([
        //     'bio' => $req->bio // tidak perlu insert user id lagi karena sudah ada direlasi
        // ]); // bisa create profile dengan pake fungsi relasi ini, jadi pertama cari user dengan id dari request lalu akses fungsi relasi profile untuk create

        $profile = Profile::create([
            'user_id' => $req->user_id,
            'bio' => $req->bio  
        ]); // sama sama create tapi tidak memakai fungsi relasi, langsung create ke model, jadi harus mengirim user_id juga


        //response json
        return response()->json([
            'message' => 'Profile Berhasil Dibuat',
            'data' => $profile
        ], 201);
    }

    public function get(Request $req, $id) {
        $user = User::with('profile')->find($id); //ambil data user dengan relasi profile

        return response()->json([
            'message' => 'User Berhasil Diambil',
            'data' => $user
        ]);
    }
}

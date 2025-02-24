<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    // One to Many relation
    // Relasi Antara Category dan Product
    // satu kategori bisa memiliki banyak product dan satu product memiliki satu category
    public function createCategory(Request $req) {
        $validasi = Validator::make($req->all(), [ //validator Illuminate\Support\Facades\Validator
            'name' => 'required' //validasi name wajib diisi
        ]);

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // Create category
        $category = Category::create([
            'name' => $req->name
        ]);

        //response json
        return response()->json([
            'message' => 'Category Berhasil Dibuat',
            'data' => $category
        ], 201);
    }

    public function createProduct(Request $req) {
        $validasi = Validator::make($req->all(), [
            'category_id' => 'required|exists:categories,id', //validasi category id harus diisi dan id itu exists di tabel categories
            'name' => 'required' //validasi name wajib diisi
        ]); 

        if($validasi->fails()) { // jika validasi gagal
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validasi->errors()
            ], 422); //return message dengan error 
        }

        // $product = Category::find($req->category_id)->product()->create([ // 
        //     'name' => $req->name // tidak perlu insert category id karena sudah melewati relasi product dengan category
        // ]); bisa create product dengan pake fungsi relasi ini, jadi pertama cari category dengan id dari request lalu akses fungsi relasi product untuk create


        // create data langsung lewat model
        $product = Product::create([
            'category_id' => $req->category_id,
            'name' => $req->name
        ]);

        return response()->json([
            'message' => 'Product berhasil dibuat',
            'data' => $product
        ]); 
    }

    public function get($id) { // $id dari parameter route
        // Get category dengan product nya
        $category = Category::with('product')->find($id);

        return response()->json([
            'message' => 'Category dengan Product berhasil diambil',
            'data' => $category
        ]);
    }
}

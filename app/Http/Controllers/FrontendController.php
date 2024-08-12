<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Passport;
use App\Models\UserTable;
use App\Models\ServiceName;

class FrontendController extends Controller
{
    //Display all Blog and category in frontend
    public function index(){

        $data['services'] = ServiceName::all();
        $data['users'] = UserTable::with('service')->get();

        return view('index',$data);
    }

    //Searching category by post browsing
    // public function postByCat($slug = null)
    // {
    //     $data['categories'] = Category::orderBy('priority','asc')->get();
    //     $blogs = Blog::orderBy('id','desc');
    //     if (!is_null($slug)) {
    //         $category = Category::where('slug', $slug)->first();

    //         if ($category) {
    //             $blogs = $blogs->whereJsonContains('category_id', (string)$category->id);
    //         }
    //     }
    //     $data['blogs'] = $blogs->get();
    //     return view('index',$data);
    // }

    // //All Blog Display in frontend functionality
    // public function blog(){
    //     $blogs = Blog::orderBy('id','desc');
    //     $data['blogs'] = $blogs->get();
    //     return view('blog', $data);
    // }

}

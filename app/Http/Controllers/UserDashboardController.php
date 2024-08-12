<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //User Dashboard functionality and Total Category, Blog and user count
    public function dashboard(){
        if(Auth::user()->user_role == 1){
            $data['total_blog'] = Blog::count();
        }elseif(Auth::user()->user_role == 2){
            $data['total_blog'] = Blog::where('created_by',Auth::user()->id)->count();
        }

        if(Auth::user()->user_role == 1){
            $data['total_category'] = Category::count();
        }elseif(Auth::user()->user_role == 2){
            $data['total_category'] = Category::where('created_by',Auth::user()->id)->count();
        }
        $data['passports'] = Passport::orderBy('id','desc')->paginate(6);
        $data['total_user'] = User::where('id', '!=', 1)->count();
        return view('pages.dashboard',$data);
    }

    //All User display Functionality
    public function allUser()
    {
        if(Auth::user()->user_role == 1){
            $data['users'] = User::where('id', '!=', 1)->orderBy('id','desc')->paginate();
            return view('pages.user.user',$data);
        }
    }
}

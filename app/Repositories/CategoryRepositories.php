<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\CategoryInterface;

class CategoryRepositories implements CategoryInterface
{

    public function all(){

        if(Auth::user()->user_role == 1){
            return Category::orderBy('priority','asc')->paginate(6);
        }elseif(Auth::user()->user_role == 2){
            return Category::where('created_by',Auth::user()->id)->orderBy('priority','asc')->paginate(6);
        }
    }

    public function store(array $data){

        $category = new Category();
        $category->name  = $data['name'];
        $category->slug = Str::slug($data['name'] ?? '');
        $category->priority  = $data['priority'];
        $category->created_by = auth()->id();
        $category->save();

    }

    public function getData($slug){
        return Category::where('slug',$slug)->first();
    }

    public function update(array $data,$slug){

        $category =  Category::where('slug',$slug)->first();
        $category->name  = $data['name'];
        $category->slug = Str::slug($data['name'] ?? '');
        $category->priority  = $data['priority'];
        $category->created_by = auth()->id();
        $category->save();
    }

    public function delete($slug){

        $category = Category::where('slug',$slug)->first();
        if(!empty($category)){
            $category->delete();
        }
    }
}

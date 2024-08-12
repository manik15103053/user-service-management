<?php
namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Interface\BlogInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Traits\Uploadable;
class BlogRepositories implements BlogInterface
{
    use Uploadable;

    public function all(){

        if(Auth::user()->user_role == 1){
            return Blog::orderBy('id','desc')->paginate(6);
        }elseif(Auth::user()->user_role == 2){
            return  Blog::where('created_by',Auth::user()->id)->orderBy('id','desc')->paginate(6);        }
    }

    public function store(array $data){

        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->slug = Str::slug($data['title']);
        $blog->category_id = json_encode($data['category_id']);
        $blog->text_content = $data['text_content'];
        $blog->publication_date = $data['publication_date'];
        $blog->created_by = auth()->id();

        if (array_key_exists('image', $data)){
            $blog->image = $this->uploadOne($data['image'], 400, 300, 'images/blog/', true);
        }

        $blog->save();

    }

    public function getData($slug){
        return  Blog::where('slug',$slug)->first();
    }

    public function update(array $data,$slug){

        $blog =  Blog::where('slug',$slug)->first();
        $blog->title = $data['title'];
        $blog->slug = Str::slug($data['title']);
        $blog->category_id = json_encode($data['category_id']);
        $blog->text_content = $data['text_content'];
        $blog->publication_date = $data['publication_date'];
        $blog->created_by = auth()->id();

        if (array_key_exists('image', $data)){
            if($blog->image){
                $this->deleteOne($blog->image);
            }
            $blog->image = $this->uploadOne($data['image'], 400, 300, 'images/blog/', true);
        }
        $blog->save();
    }

    public function delete($slug){

        $blog = Blog::where('slug',$slug)->first();
        if($blog->image){
            $this->deleteOne($blog->image);
        }
        if(!empty($blog)){
            $blog->delete();
        }
    }
}

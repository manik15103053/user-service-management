<?php
namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\AuthorInterface;

class AuthorRepositories implements AuthorInterface
{

    public function all(){
        return Author::orderBy('id','asc')->paginate(15);
    }

    public function store(array $data){
        $Author = new Author();
        $Author->name  = $data['name'];
        $Author->bio  = $data['bio'];
        $Author->save();

    }

    public function getData($id){
        return Author::find($id);
    }

    public function update(array $data,$id){
        $Author =  Author::find($id);
        $Author->name  = $data['name'];
        $Author->bio  = $data['bio'];
        $Author->save();
    }

    public function delete($id){
        $Author = Author::find($id);
        if(!empty($Author)){
            $Author->delete();
        }
    }
}

<?php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\BookInterface;

class BookRepositories implements BookInterface
{

    public function all(){

       return Book::orderBy('id','asc')->paginate(6);
    }

    public function store(array $data){

        $Book = new Book();
        $Book->title  = $data['title'];
        $Book->isbn  = $data['isbn'];
        $Book->author_id  = $data['author_id'];
        $Book->published_date  = $data['published_date'];
        $Book->available_copy  = $data['available_copy'];
        $Book->total_copy  = $data['total_copy'];
        $Book->save();

    }

    public function getData($id){
        return Book::find($id);
    }

    public function update(array $data,$id){

        $Book =  Book::where('id',$id)->first();
        $Book->title  = $data['title'];
        $Book->isbn  = $data['isbn'];
        $Book->author_id  = $data['author_id'];
        $Book->published_date  = $data['published_date'];
        $Book->available_copy  = $data['available_copy'];
        $Book->total_copy  = $data['total_copy'];
        $Book->save();
    }

    public function delete($id){

        $Book = Book::find($id);
        if(!empty($Book)){
            $Book->delete();
        }
    }
}

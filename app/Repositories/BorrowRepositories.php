<?php
namespace App\Repositories;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowBook;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\BorrowInterface;

class BorrowRepositories implements BorrowInterface
{

    public function all(){

       return BorrowBook::orderBy('id','asc')->paginate(6);
    }

    public function store(array $data){

        $Borrow = new BorrowBook();
        $Borrow->member_id  = $data['member_id'];
        $Borrow->book_id  = $data['book_id'];
        $Borrow->borrow_date  = $data['borrow_date'];
        $Borrow->return_date  = $data['return_date'];
        $Borrow->status  ='Borrowed';
        $Borrow->save();
        $book=Book::where('id',$data['book_id'])->first();
        $book->available_copy-=1;
        $book->save();

    }

    public function getData($id){
        return BorrowBook::find($id);
    }

    public function update(array $data,$id){

        $Borrow =  BorrowBook::where('id',$id)->first();
        $Borrow->member_id  = $data['member_id'];
        $Borrow->book_id  = $data['book_id'];
        $Borrow->borrow_date  = $data['borrow_date'];
        $Borrow->return_date  = $data['return_date'];
        $Borrow->status  =$data['status'];
        $Borrow->save();
        if($Borrow->status=='Returned'){
            $book=Book::where('id',$data['book_id'])->first();
            $book->available_copy+=1;
            $book->save();
        }
    }

    public function delete($id){

        $Borrow = BorrowBook::find($id);
        if(!empty($Borrow)){
            $Borrow->delete();
        }
    }
}

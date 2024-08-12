<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\BorrowRequest;
use App\Repositories\BorrowRepositories;


class BorrowController extends Controller
{
    protected $Borrow;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(BorrowRepositories $Borrow)
    {
            $this->Borrow = $Borrow;
    }

    //Show all Borrows in read operation
    public function index()
    {
        try{
            $data['borrows'] = $this->Borrow->all();
            return view('pages.borrow.index',$data);
        }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }
    }

    //Borrow Cerate page
    public function create()
    {
        $data['books'] = Book::orderBy('id','asc')->get();
        $data['members'] = Member::orderBy('id','asc')->get();
        return view('pages.borrow.create',$data);
    }

    //Borrow Store Functionality use validation in Borrow request
    public function store(BorrowRequest $request)
    {

        try {
            $this->Borrow->store($request->all());
            return redirect()->route('borrow.index')->with('success', 'Borrow created successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }

    }
    //Edit Functionality show edit pages
    public function edit($id)
    {
        $data['borrow'] = $this->Borrow->getData($id);
        if($data['borrow']->status =='Returned'){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
        $data['books'] = Book::orderBy('id','asc')->get();
        $data['members'] = Member::orderBy('id','asc')->get();
        return view('pages.borrow.edit',$data);
    }

    //Update Functionality use validation in Borrow request
    public function update(Request $request, $id)
    {

        try {
            $this->Borrow->update($request->all(), $id);
            return redirect()->route('borrow.index')->with('success', 'Borrow updated successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    //Delete Functionality
    public function delete($id)
    {
        try {

            $this->Borrow->delete($id);
            return redirect()->back()->with('success','Borrow Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}

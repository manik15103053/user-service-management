<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepositories;


class BookController extends Controller
{
    protected $Book;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(BookRepositories $Book)
    {
            $this->Book = $Book;
    }

    //Show all Books in read operation
    public function index()
    {
        try{
            $data['books'] = $this->Book->all();
            return view('pages.book.index',$data);
        }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }
    }

    //Book Cerate page
    public function create()
    {
        $data['authors'] = Author::orderBy('id','asc')->get();
        return view('pages.book.create',$data);
    }

    //Book Store Functionality use validation in Book request
    public function store(BookRequest $request)
    {

        try {
            $this->Book->store($request->all());
            return redirect()->route('book.index')->with('success', 'Book created successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }

    }
    //Edit Functionality show edit pages
    public function edit($id)
    {
        $data['book'] = $this->Book->getData($id);
        $data['authors'] = Author::orderBy('id','asc')->get();
        return view('pages.book.edit',$data);
    }

    //Update Functionality use validation in Book request
    public function update(Request $request, $id)
    {

        try {
            $this->Book->update($request->all(), $id);
            return redirect()->route('book.index')->with('success', 'Book updated successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    //Delete Functionality
    public function delete($id)
    {
        try {

            $this->Book->delete($id);
            return redirect()->back()->with('success','Book Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}

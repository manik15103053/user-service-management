<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Category;
use App\Repositories\AuthorRepositories;
use Exception;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    protected $Author;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(AuthorRepositories $Author)
    {
            $this->Author = $Author;
    }

    //Show all Authors in read operation
    public function index()
    {
        try{
            $data['authors'] = $this->Author->all();
            return view('pages.author.index',$data);
        }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }
    }

    //Author Cerate page
    public function create()
    {
        return view('pages.author.create');
    }

    //Author Store Functionality use validation in Author request
    public function store(AuthorRequest $request)
    {

        try {
            $this->Author->store($request->all());
            return redirect()->route('author.index')->with('success', 'Author created successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }

    }
    //Edit Functionality show edit pages
    public function edit($id)
    {
        $data['author'] = $this->Author->getData($id);
        return view('pages.author.edit',$data);
    }

    //Update Functionality use validation in Author request
    public function update(Request $request, $id)
    {

        try {
            $this->Author->update($request->all(), $id);
            return redirect()->route('author.index')->with('success', 'Author updated successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    //Delete Functionality
    public function delete($id)
    {
        try {

            $this->Author->delete($id);
            return redirect()->back()->with('success','Author Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Interface\CategoryInterface;
use Exception;

class CategoryController extends Controller
{
    protected $category;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(CategoryInterface $category)
    {
            $this->category = $category;
    }

    //Show all Category in read operation
    public function index()
    {
        try{
            $data['categories'] = $this->category->all();
            return view('pages.category.index',$data);
        }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }

    }

    //Category Cerate page
    public function create()
    {
        return view('pages.category.create');
    }

    //Category Store Functionality use validation in category request
    public function store(CategoryRequest $request)
    {
        try {
            $this->category->store($request->all());
            return redirect()->route('category.index')->with('success','Category Created Successfully');
        }catch (Exception $e){
            return redirect()->route('category.create')->with('error','Sorry Something went to wrong');
        }

    }

    //Edit Functionality show edit pages
    public function edit($slug)
    {

        try {
            $data['category'] = $this->category->getData($slug);
            return view('pages.category.edit',$data);
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    //Update Functionality use validation in category request
    public function update(CategoryRequest $request, $slug)
    {
        try {
            $this->category->update($request->all(),$slug);
            return redirect()->route('category.index')->with('success','Category Updated Successfully');
        }catch (Exception $e){
            return redirect()->route('category.edit')->with('error','Sorry Something went to wrong');
        }

    }

    //Delete Functionality
    public function delete($slug)
    {
        try {

            $this->category->delete($slug);
            return redirect()->back()->with('success','Category Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}

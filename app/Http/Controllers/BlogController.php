<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Category;
use App\Repositories\BlogRepositories;
use Exception;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    protected $blog;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(BlogRepositories $blog)
    {
            $this->blog = $blog;
    }

    //Show all Blogs in read operation
    public function index()
    {
        try{
            $data['blogs'] = $this->blog->all();
            return view('pages.blog.index',$data);
        }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }
    }

    //Blog Cerate page
    public function create()
    {
        $data['categories'] = Category::orderBy('priority','asc')->get();
        return view('pages.blog.create',$data);
    }

    //Blog Store Functionality use validation in Blog request
    public function store(BlogRequest $request)
    {

        try {
            $this->blog->store($request->all());
            return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
        }catch (Exception $e){
            return redirect()->route('blog.create')->with('error','Sorry Something went to wrong');
        }

    }
    //Edit Functionality show edit pages
    public function edit($slug)
    {
        $data['blog'] = $this->blog->getData($slug);
        $data['categories'] = Category::orderBy('priority','asc')->get();
        return view('pages.blog.edit',$data);
    }

    //Update Functionality use validation in Blog request
    public function update(Request $request, $slug)
    {

        try {
            $this->blog->update($request->all(), $slug);
            return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
        }catch (Exception $e){
            return redirect()->route('blog.edit')->with('error','Sorry Something went to wrong');
        }
    }

    //Delete Functionality
    public function delete($slug)
    {
        try {

            $this->blog->delete($slug);
            return redirect()->back()->with('success','Blog Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}

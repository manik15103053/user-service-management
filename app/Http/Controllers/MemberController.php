<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Category;
use App\Repositories\MemberRepositories;
use Exception;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    protected $Member;

    //Use Access Modifier and maintain the all functionality in repositories interface
    public function __construct(MemberRepositories $Member)
    {
            $this->Member = $Member;
    }

    //Show all Members in read operation
    public function index()
    {
        try{
            $data['members'] = $this->Member->all();
            return view('pages.member.index',$data);
       }catch(Exception $e){
            return back()->with('error', 'Sorry Something went wrong.');
        }
    }

    //Member Cerate page
    public function create()
    {
        return view('pages.member.create');
    }

    //Member Store Functionality use validation in Member request
    public function store(MemberRequest $request)
    {

        try {
            $this->Member->store($request->all());
            return redirect()->route('member.index')->with('success', 'Member created successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }

    }
    //Edit Functionality show edit pages
    public function edit($id)
    {
        $data['member'] = $this->Member->getData($id);
        return view('pages.member.edit',$data);
    }

    //Update Functionality use validation in Member request
    public function update(Request $request, $id)
    {

        try {
            $this->Member->update($request->all(), $id);
            return redirect()->route('member.index')->with('success', 'Member updated successfully.');
        }catch (Exception $e){
            return redirect()->back()->with('error','Sorry Something went to wrong');
        }
    }

    //Delete Functionality
    public function delete($id)
    {
        try {
            $this->Member->delete($id);
            return redirect()->back()->with('success','Member Deleted Successfully');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Something went to wrong');
        }
    }
}


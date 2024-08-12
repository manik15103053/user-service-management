<?php
namespace App\Repositories;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interface\MemberInterface;

class MemberRepositories implements MemberInterface
{

    public function all(){

        return Member::orderBy('id','asc')->paginate(6);
    }

    public function store(array $data){

        $Member = new Member();
        $Member->first_name  = $data['first_name'];
        $Member->last_name  = $data['last_name'];
        $Member->email  = $data['email'];
        $Member->phone  = $data['phone'];
        $Member->save();

    }

    public function getData($id){
        return Member::find($id);
    }

    public function update(array $data,$id){

        $Member =  Member::find($id);
        $Member->first_name  = $data['first_name'];
        $Member->last_name  = $data['last_name'];
        $Member->email  = $data['email'];
        $Member->phone  = $data['phone'];
        $Member->save();
    }

    public function delete($id){

        $Member = Member::find($id);
        if(!empty($Member)){
            $Member->delete();
        }
    }
}

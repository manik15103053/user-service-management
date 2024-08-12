<?php

namespace App\Repositories\Interface;
interface MemberInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$id);
    public function getData($id);
    public function delete($id);

}

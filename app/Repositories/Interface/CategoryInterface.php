<?php

namespace App\Repositories\Interface;
interface CategoryInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$slug);
    public function getData($slug);
    public function delete($slug);

}

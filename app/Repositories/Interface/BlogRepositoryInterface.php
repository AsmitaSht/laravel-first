<?php

namespace App\Repositories\Interface;
use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function store($data);
    public function update(Blog $blog,array $data);
    public function delete(Blog $blog);
    
}

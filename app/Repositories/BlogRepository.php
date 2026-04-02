<?php
namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Interface\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface{
    public function store($data){
        return Blog::create($data);
    }
    public function update(Blog $blog,array $data){
        return $blog->update($data);
    }
    public function delete(Blog $blog){
        return $blog->delete();
    }
}
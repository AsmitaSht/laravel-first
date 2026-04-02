<?php
namespace App\Services;

use App\Models\Blog;    
use App\Repositories\Interface\BlogRepositoryInterface;

class BlogServices{
    public function __construct(protected BlogRepositoryInterface $blogRepository)
    {    }

    public function store($data){
        return $this->blogRepository->store($data);
    }
    public function update(Blog $blog,array $data){
        return $this->blogRepository->update($blog,$data);
    }
    public function delete(Blog $blog){
        return $this->blogRepository->delete($blog);
    }

}
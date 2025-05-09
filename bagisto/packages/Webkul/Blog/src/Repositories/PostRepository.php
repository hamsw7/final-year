<?php

namespace Webkul\Blog\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Blog\Models\Post;

class PostRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }

    /**
     * Create a new post
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return parent::create($data);
    }

    /**
     * Update a post
     *
     * @param array $data
     * @param int $id
     * @return Post
     */
    public function update(array $data, $id): Post
    {
        $post = $this->findOrFail($id);
        parent::update($data, $id);
        return $post;
    }

    /**
     * Delete a post
     *
     * @param int $id
     * @return void
     */
    public function delete($id): void
    {
        parent::delete($id);
    }

    /**
     * Get all posts
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->getModel()->all();
    }
}

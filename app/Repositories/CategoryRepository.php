<?php

namespace App\Repositories;

use App\Admin;
use App\Category;

class CategoryRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  Admin  $admin
     * @return Collection
     */
    public function forUser(Admin $admin)
    {
        return Category::where('user_id', $admin->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function get_parent()
    {
        return Category::select('category', 'id')
                        ->from('categories')
                        ->where('parentcategory', '0')
                        ->get();
    }
}
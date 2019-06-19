<?php

namespace App\Repositories;

use App\User;
use App\Gallery;
use App\CoverImage;

class GalleryRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  Admin  $admin
     * @return Collection
     */
    public function forUser(Admin $admin)
    {
        return Gallery::where('user_id', $admin->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function get_gallery($id)
    {
        return Gallery::select('*')
        ->from('galleries')
        ->where('cover_id', $id)
        ->get();
    }

   
}
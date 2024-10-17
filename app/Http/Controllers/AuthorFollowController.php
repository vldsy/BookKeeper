<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorFollowController extends Controller
{
    public function store(Author $author, Request $request)
    {
        dd($author->id);
        return back();
    }

    public function destroy(Author $author, Request $request)
    {
        return back();
    }
}

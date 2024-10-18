<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthorFollowController extends Controller
{
    public function store(Author $author, Request $request)
    {
        // currently signed user follows this author
        $userId = Auth::id();

        $users = [];
        $users[$userId] = [
            'follow' => 1
        ];
        $author->users()->syncWithoutDetaching($users);
        // syncWithoutDetaching -- other options:
        // attach -- data will be duplicated if used twice
        // sync -- add only those and remove others

        return back();
    }

    public function destroy(Author $author, Request $request)
    {
        $userId = Auth::id();
        $users = [];
        $users[] = $userId;

        $author->users()->detach($users);

        return back();
    }
}

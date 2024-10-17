<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookLikeController extends Controller
{
    public function store(Book $book, Request $request)
    {
        $userId = Auth::id();

        $users = [];
        $users[$userId] = [
            'favorite' => 1
        ];
        $book->users()->syncWithoutDetaching($users);

        return back();
    }

    public function destroy(Book $book, Request $request)
    {
        $userId = Auth::id();

        $users = [];
        $users[$userId] = [
            'favorite' => 0
        ];
        $book->users()->syncWithoutDetaching($users);

        return back();
    }
}

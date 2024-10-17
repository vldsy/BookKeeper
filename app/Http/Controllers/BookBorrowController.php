<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function store(Book $book, Request $request)
    {
        $userId = Auth::id();

        $users = [];
        $users[$userId] = [
            'borrowed' => 1
        ];
        $book->users()->syncWithoutDetaching($users);

        dd($book->id);

        return back();
    }

    public function destroy(Book $book, Request $request)
    {
        $userId = Auth::id();

        $users = [];
        $users[$userId] = [
            'borrowed' => 0
        ];
        $book->users()->syncWithoutDetaching($users);

        return back();
    }
}

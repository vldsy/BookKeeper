<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookLikeController extends Controller
{
    public function store(Book $book, Request $request)
    {
        return back();
    }

    public function destroy(Book $book, Request $request)
    {
        return back();
    }
}

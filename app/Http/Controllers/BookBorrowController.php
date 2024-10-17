<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookBorrowController extends Controller
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

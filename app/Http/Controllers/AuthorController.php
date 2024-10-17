<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with(['users'])->orderBy('created_at', 'desc')->get();
        foreach ($authors as $author) {
            if ($author->pivot && $author->pivot->users) {
                //dd($author->pivot->users);
                //echo $author->pivot->users;
            }

            if ($author->id == 54) {
                //dd($author);
            }
        }

        //dd($authors);

        return Inertia::render('Authors/Index', [
            'authors' => Author::with(['users'])->orderBy('created_at', 'desc')->get(),
        ]);
    }
}

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

        //dd($author->id, $userId);

        $users = [];
        $users[$userId] = [
            'follow' => 1
        ];
        $author->users()->syncWithoutDetaching($users);

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

    public function addUsers(Author $author) // add users to author
    {

    }

    // to move to another controller
    public function addAuthors(Request $request, User $user) // add authors to user
    {
        // adds
        $user->authors()->attach($request->authors);
        // data will be duplicated if used twice

        $user->authors()->sync($request->authors);
        // deletes dta that is already present if it's not in params
        // add only those and remove others

        // // working with extra column
        // $authors = [
        //     'author_id' => [
        //         'follow' => 0 // extra column
        //     ]
        // ];
        $authors = [];
        foreach ($request->authors as $authorId) {
            $authors[$authorId] = [
                'follow' => 1
            ];
        }



        $user->authors()->syncWithoutDetaching($request->authors);
        // does not delete previous data
        // if it exists -- keep it, if does not exist -- attach it

        return 'Attached';
    }

    public function removeAuthor(Request $request, User $user)
    {
        // removes
        $user->authors()->detach($request->authors);
    }

    public function show(User $user)
    {
        // get all
        return $user->load('authors');
        // the data will come under "pivot" key
        // authors/pivot/{data from author_user}
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Comment;

class CommentController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $comments = Comment::orderBy('created_at', 'asc')->get();

        return view('comments.index', [
            'comments' => $comments,
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:255',
        ]);

        $request->user()->comments()->create([
            'text' => $request->text,
        ]);

        return redirect('/comments');
    }

    public function delete(Request $request, Comment $comment)
    {
        $this->authorize('remove', $comment);

        $comment->delete();

        return redirect('/comments');
    }
}

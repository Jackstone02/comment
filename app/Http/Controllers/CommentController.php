<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function getAllComments()
    {
        $comments = Comment::orderBy('created_at', 'DESC')
                            ->with('secondaryComments')
                            ->with('secondaryComments.tertiaryComments')
                            ->get();

        $response = array(
            "status" => "success",
            "result" => $comments
        );

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        Comment::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        $response = array(
            "status" => "success",
        );

        return response()->json($response, 200);
    }
}

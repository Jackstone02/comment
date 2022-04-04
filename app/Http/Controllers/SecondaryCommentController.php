<?php

namespace App\Http\Controllers;

use App\Models\SecondaryComment;
use Illuminate\Http\Request;

class SecondaryCommentController extends Controller
{
    //
    public function store(Request $request)
    {
        SecondaryComment::create([
            'comment_id' => $request->comment_id,
            'name' => $request->name,
            'message' => $request->message,
        ]);

        $response = array(
            "status" => "success",
        );

        return response()->json($response, 200);
    }
}

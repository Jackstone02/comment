<?php

namespace App\Http\Controllers;

use App\Models\TertiaryComment;
use Illuminate\Http\Request;

class TertiaryCommentController extends Controller
{
    //
    public function store(Request $request)
    {
        TertiaryComment::create([
            'secondary_comment_id' => $request->secondary_comment_id,
            'name' => $request->name,
            'message' => $request->message,
        ]);

        $response = array(
            "status" => "success",
        );

        return response()->json($response, 200);
    }
}

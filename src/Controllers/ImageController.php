<?php

namespace Kyong\RandomImageS3\Controllers;

use Kyong\RandomImageS3\HashRelation;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $contents = HashRelation::getImage($request->hash, $request->w, $request->h);
        $response = response()->make($contents, 200);
        $response->header("Content-Type", 'image/png');
        return $response;
    }
}

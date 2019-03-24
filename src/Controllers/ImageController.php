<?php

namespace Kyong\RandomImageS3\Controllers;

use Kyong\RandomImageS3\HashRelation;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $contents = HashRelation::getImageResponse($request->hash, $request->w, $request->h);
        return \Response::make($contents, 200, ['Content-Type'=>'image/jpg']);

    }
}

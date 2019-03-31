<?php
namespace Kyong\RandomImageS3;

use Intervention\Image\ImageManagerStatic as Image;

class RandomImage
{

    public static function makeUrl($w=600, $h=400)
    {
        $list = \Storage::disk(config('random-image-s3.disk', 's3'))->allFiles();
        $list = array_filter($list, function($path, $k){
            return preg_match( '/.*?(\.png|\.jpg|\.jpeg)$/', $path);
        }, ARRAY_FILTER_USE_BOTH);
        $file_path = $list[array_rand($list)];
        $hashRelation = new HashRelation();
        $hashRelation->path = $file_path;
        $hashRelation->save();
        return route( 'getImage', ['hash'=>$hashRelation->hash, 'w'=>$w, 'h'=>$h]);
    }

    public static function getImageResponse($hash, $w=600, $h=400)
    {
        $relation = HashRelation::where(['hash' => $hash])->get()->first();
        // TODO: エラー処理

        if( config('random-image-s3.iscache') ){
            $cache_path = config('random-image-s3.chache-dir'). '/' . $hash . '/w' . $w  . 'h' . $h; 
            if(\Storage::disk(config('random-image-s3.chache-disk', 'local'))->exists( $cache_path )){
                return \Storage::disk(config('random-image-s3.chache-disk', 'local'))->get( $cache_path );
            }
        }

        $image = \Storage::disk(config('random-image-s3.disk', 's3'))->get($relation->path);
        $response = Image::make($image)->fit($w, $h)->stream('jpg');

        if( config('random-image-s3.ischache') ){
            \Storage::put( $cache_path, $response );
        }
        
        return $response;
    }
}
<?php

namespace Kyong\RandomImageS3;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class HashRelation extends Model
{
    protected $table = 'hash_relations';
    protected $fillable = [
        'path',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($hashRelation) {
            $hashRelation->hash = (string) \Illuminate\Support\Str::uuid();
            return $hashRelation;
        });

    }

    public static function makeUrl($w=600, $h=400)
    {
        $list = \Storage::disk('s3')->allFiles();
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
        $relation = self::where(['hash' => $hash])->get()->first();
        // TODO: エラー処理

        $cache_path = config('random-image-s3.chache'). '/' . $hash . '/w' . $w  . 'h' . $h; 
        if(\Storage::disk('local')->exists( $cache_path )){
            return \Storage::disk('local')->get( $cache_path );
        }

        $image = \Storage::disk('s3')->get($relation->path);
        $response = Image::make($image)->fit($w, $h)->stream('jpg');
        \Storage::put( $cache_path, $response );
        return $response;
    }

}

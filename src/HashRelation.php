<?php

namespace Kyong\RandomImageS3;

use Illuminate\Database\Eloquent\Model;

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
        $file_path = $list[array_rand($list)];
        $hashRelation = new HashRelation();
        $hashRelation->path = $file_path;
        $hashRelation->save();
        return route( 'getImage', ['hash'=>$hashRelation->hash, 'w'=>$w, 'h'=>$h]);
    }

    public static function getImage($hash, $w=null, $h=null)
    {
        $relation = self::where(['hash' => $hash])->get()->first();
        // TODO: エラー処理
        return \Storage::disk('s3')->get($relation->path);
    }

}

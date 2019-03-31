<?php

namespace Kyong\RandomImageS3;

use Illuminate\Database\Eloquent\Model;

class HashRelation extends Model
{
    protected $table = 'random_image_hash_relations';
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
}

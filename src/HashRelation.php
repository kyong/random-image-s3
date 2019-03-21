<?php

namespace Kyong\RandomImageS3;

use Illuminate\Database\Eloquent\Model;

class HashRelation extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::creating(function($hashRelation) {
            $hashRelation->hash = \Illuminate\Support\Str::uuid();
            return $hashRelation;
        });

    }
}

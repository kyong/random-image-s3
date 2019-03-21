<?php
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => config('random-image-s3.uri')], function()
{
	Route::get('/{hash}/w{w}/h{h}/', [
		'as' => 'getImage',
		'uses' => '\Kyong\RandomImageS3\Controllers\ImageController@getImage',
    ]);
}
);
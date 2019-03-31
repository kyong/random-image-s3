Random Image S3
====

Overview

## Description

AWS s3 bucket in image list to random image by mock 

## Demo

```
use Kyong\RandomImageS3\HashRelation;

HashRelation::makeUrl();

// http://localhost/randomimage/4668c22a-50f8-428f-8de4-25392e7d3e17/w600/h400


```


## Install

```

composer require kyong/random-image-s3

php artisan vendor:publish --provider="Kyong\RandomImageS3\RandomImageS3ServiceProvider"

php artisan migrate

```


## Licence

[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)

## Author

[kyong](https://github.com/kyong)
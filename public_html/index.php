<?php
require '../vendor/autoload.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);


use Intervention\Image\ImageManagerStatic as Image;

$img = Image::make('girl.jpg');

$img->resize(200, null, function (\Intervention\Image\Constraint $constraint) {
    $constraint->aspectRatio();
});

$img->text('Watermark', $img->getWidth() - 10, $img->getHeight() - 10, function (\Intervention\Image\AbstractFont $font) {
    $font->size(34);
    // вот тут с загрузой своего шрифта прикол какой-то, пока я не дописал __DIR__ - он выкидывал исключение.
    $font->file(__DIR__ . '/verdana.ttf');
    $font->color([2555, 255, 255, 0.3]);
    $font->align('right');
    $font->valign('bottom');
});

$img->save('test.jpg');

echo $img->response('jpg');
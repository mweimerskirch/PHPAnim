<?php
require '../vendor/autoload.php';
use PHPAnim\Selector;
use PHPAnim\Animation;
use PHPAnim\Keyframe;

?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta content="">
    <style>
        body {
            overflow: hidden;
        }

        #container {
            width: 100px;
            height: 100px;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        <?php

        $selector = new Selector('.box');
        $selector->setCSS([
            'background' => 'red',
            'height' => '100px',
            'width' => '100px',
        ]);
        $animation = $selector->createAnimation();
        $animation
            ->addKeyframe(new Keyframe(0, [
                'opacity' => 0,
                'margin' => '-200px 0 0 -200px',
            ]))
            ->addKeyframe(new Keyframe(5, [
                'opacity' => 1,
                'margin' => 0,
            ]));

        echo $selector->toCSS();

        ?>
    </style>
</head>
<body>
<div id="container">
    <div class="box"></div>
</div>
</body>
</html>
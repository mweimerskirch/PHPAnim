<?php
require '../vendor/autoload.php';
use PHPAnim\Selector;
use PHPAnim\SimpleAnimation;
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
            'position' => 'absolute',
        ]);
        $animation = new SimpleAnimation();
        $animation
            ->hide()
            ->moveTo(-100, -100)
            ->rotateTo(90)
            ->nextFrame(2.5)
            ->show()
            ->endFrame();
        $selector->addAnimation($animation);

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
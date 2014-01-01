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

        for($i=0; $i< 100; $i++) {
            $selector = new Selector('#box'.$i);
            $selector->setCSS([
                'background' => 'red',
                'height' => '100px',
                'width' => '100px',
                'position' => 'absolute'
            ]);
            $animation = $selector->createAnimation();
            $animation
                ->addKeyframe(new Keyframe(0, [
                    'opacity' => 0,
                    'margin' => rand(-1000, 1000).'px 0 0 '.rand(-1000, 1000).'px',
                ]))
                ->addKeyframe(new Keyframe(5, [
                    'opacity' => 1,
                    'margin' => 0,
                ]))
                ->setTimingFunction('ease-in');

            echo $selector->toCSS();
        }

        ?>
    </style>
</head>
<body>
<div id="container">
    <?php for ($i = 0; $i < 100; $i++): ?>
        <div class="box" id="box<?= $i ?>"></div>
    <?php endfor ?>
</div>
</body>
</html>
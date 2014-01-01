<?php
require '../vendor/autoload.php';
use PHPAnim\Selector;
use PHPAnim\PathAnimation;
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
            border: 1px solid black;
            width: 339px;
            height: 218px;
            margin: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        <?php

        $selector = new Selector('.dot');
        $selector->setCSS([
            'position' => 'absolute',
            'left' => 0,
            'bottom' => 0,
            'background' => 'black',
            'height' => '10px',
            'width' => '10px',
            'margin-left' => '-5px',
            'margin-top' => '5px',
        ]);
        $svg_path = 'M 0.5,196.66692 70.363128,75.66044 213.08414,218.38145 338.87806,0.5';
        $animation = new PathAnimation($svg_path, 100, 0, 1);
        $animation
            ->setIterationCount('infinite')
            ->setDirection('alternate')
            ->setTimingFunction('linear');
        $selector->addAnimation($animation);

        echo $selector->toCSS();

        ?>
    </style>
</head>
<body>
<div id="container">
    <div class="dot"></div>
</div>
</body>
</html>
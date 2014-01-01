PHPAnim
=======

CSS3 animation tool for PHP

Advantages over writing the CSS manually:
* No need to worry about CSS vendor prefixes, they are added automatically.
* The animation times can be specified in seconds. The %-values for the keyframes are calculated automatically.
* The animations can be generated using the full power of PHP: loops, values from a database, etc.
* No performance penalties compared to using a JavaScript library to generate the CSS.

## Installation

The tool does not provide an autoloader but follow the PSR-0 convention. You
can use any compliant autoloader, for example the [Symfony2 ClassLoader component](http://symfony.com/doc/master/components/class_loader/index.html).

If you use composer, adding something like this should be sufficient:
```php
<?php
require 'vendor/autoload.php';
use PHPAnim\Selector;
use PHPAnim\Animation;
use PHPAnim\Keyframe;
```

If you really want to use the tool standalone, you can manually require all the .php files in src/PHPAnim.

## Usage

Following is a simple example of how to use the tool. Here, one or more HTML elements targeted by the CSS selector ".box" are animated from opacity 0 to opacity 1.

```php
<style>
<?php
$selector = new Selector('.box');
$animation = $selector->createAnimation();
$animation
    ->addKeyframe(new KeyFrame(0, ['opacity' => 0]));
    ->addKeyframe(new Keyframe(5, ['opacity' => 1]));
echo $selector->toCSS();
?>
</style>
```

You can of course specify multiple CSS properties at the same time:

```php
new KeyFrame(0, ['opacity' => 0, 'margin' => '-200px 0 0 -200px']));
```

The animation name is generated randomly. You can optionally specify a custom name:

```php
$animation->setName('myAnimation');
```

If you want your animation to start after an initial delay, you can specify a delay (in seconds):

```php
// either in the constructor:
new Anmation(1.5);

// ... or by using a setter:
$animation->setDelay(1.5);
```

You can also set additional CSS properties for the animation. See the inline documentation for details.

```php
$animation->setDirection(...);
$animation->setFillMode(...);
$animation->setIterationCount(...);
$animation->setPlayState(...);
$animation->setTimingFunction(...);
```

If you want to keep everything in one place, you can set initial CSS properties for your object.

```php
$selector->setCSS([
    'background' => 'red',
    'height' => '100px',
    'width' => '100px',
]);
```

Instead of using CSS, you can also create animations using the "SimpleAnimation" class.

```php
$animation = new SimpleAnimation();
$animation
    ->hide()
    ->moveTo(-100, -100)
    ->rotateTo(90)
    ->nextFrame(2.5)
    ->show()
    ->endFrame();
$selector->addAnimation($animation);
```

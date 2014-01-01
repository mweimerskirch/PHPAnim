<?php

namespace PHPAnim;

class Selector
{

    protected $name;
    protected $css;
    protected $animations;

    /**
     * @param $name Selector name
     */
    function __construct($name)
    {
        $this->name = $name;
        $this->css = array();
        $this->animations = array();
    }

    /**
     * @param float $delay The delay for the the beginning of the animation sequence.
     * @return Animation
     */
    public function createAnimation($delay = 0.0)
    {
        $animation = new Animation($delay);
        $this->animations[] = $animation;
        return $animation;
    }

    /**
     * @param Animation $animation
     * @return Animation
     */
    public function addAnimation($animation)
    {
        $this->animations[] = $animation;
        return $animation;
    }

    /**
     * @return string
     */
    public function toCSS()
    {
        $css = '';
        foreach ($this->animations as $animation) {
            $css .= $animation->getAnimationCSS();
        }
        $css .= $this->name;
        $css .= '{';
        foreach ($this->css as $property => $value) {
            $css .= $property . ': ' . $value . ';';
        }
        foreach ($this->animations as $animation) {
            $css .= $animation->toCSS();
        }
        $css .= '}';
        return $css;
    }

    /**
     * @param array $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }

    /**
     * @return array
     */
    public function getCss()
    {
        return $this->css;
    }

} 
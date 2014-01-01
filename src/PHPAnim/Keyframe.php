<?php

namespace PHPAnim;

class Keyframe
{

    protected $duration;
    protected $css;

    /**
     * @param float $duration
     * @param array $css
     */
    function __construct($duration, $css)
    {
        $this->duration = $duration;
        $this->css = $css;
    }

    /**
     * @param $totalDuration
     * @return string
     */
    public function toCSS($offset, $totalDuration)
    {
        $css = '';
        $css .= ((($offset + $this->duration) / $totalDuration) * 100) . '% ';
        $css .= '{';
        foreach ($this->css as $property => $value) {
            $css .= $property . ': ' . $value . ';';
        }
        $css .= '}';
        return $css;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

} 
<?php

namespace PHPAnim;


class SimpleAnimation extends Animation
{
    protected $temp_css;
    protected $temp_duration;

    /**
     * @param float $delay
     */
    function __construct($delay = 0.0)
    {
        parent::__construct($delay);
        $this->temp_css = array();
        $this->temp_duration = 0;
    }

    /**
     * @param float $duration
     * @return $this
     */
    public function nextFrame($duration)
    {
        $keyframe = new Keyframe($this->temp_duration, $this->temp_css);
        $this->addKeyframe($keyframe);
        $this->temp_css = array();
        $this->temp_duration = $duration;

        return $this;
    }

    /**
     * @return $this
     */
    public function endFrame()
    {
        $this->nextFrame(0);

        return $this;
    }

    /**
     * @param int $left
     * @param int $top
     * @return $this
     */
    public function moveTo($left, $top)
    {
        $this->temp_css['left'] = $left . 'px';
        $this->temp_css['top'] = $top . 'px';
        return $this;
    }

    /**
     * @param int $rotation
     * @return $this
     */
    public function rotateTo($rotation)
    {
        foreach (array('-ms-', '-webkit-', '') as $prefix) {
            $this->temp_css[$prefix . 'transform'] = 'rotate(' . $rotation . 'deg)';
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function hide()
    {
        $this->temp_css['opacity'] = 0;
        return $this;
    }

    /**
     * @return $this
     */
    public function show()
    {
        $this->temp_css['opacity'] = 1;
        return $this;
    }

} 
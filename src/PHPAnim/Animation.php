<?php

namespace PHPAnim;

class Animation
{

    protected $name;
    protected $totalDuration;
    protected $keyframes;
    protected $delay;
    protected $direction;
    protected $iterationCount;
    protected $playState;
    protected $timingFunction;
    protected $fillMode;

    /**
     * @param float $delay The delay for the the beginning of the animation sequence.
     */
    function __construct($delay = 0.0)
    {
        $this->name = uniqid('a');
        $this->totalDuration = 0;
        $this->keyframes = array();
        $this->delay = $delay;
    }

    /**
     * @param Keyframe $keyframe
     * @return Animation
     */
    public function addKeyframe($keyframe)
    {
        $this->keyframes[] = $keyframe;
        $this->totalDuration += $keyframe->getDuration();

        return $this;
    }

    /**
     * @return string
     */
    public function getAnimationCSS()
    {
        $css = '';
        foreach (['-webkit-', ''] as $prefix) {
            $offset = 0;
            $css .= '@' . $prefix . 'keyframes ' . $this->name . ' {';
            foreach ($this->keyframes as $keyframe) {
                $css .= $keyframe->toCSS($offset, $this->totalDuration);
                $offset += $keyframe->getDuration();
            }
            $css .= '}';
        }
        return $css;
    }

    /**
     * @return string
     */
    public function toCSS()
    {
        $css = '';
        foreach (['-webkit-', ''] as $prefix) {
            $css .= sprintf($prefix . 'animation: %s %ss;', $this->name, $this->totalDuration);
            if ($this->delay) {
                $css .= sprintf($prefix . 'animation-delay: %ss;', $this->delay);
            }
            if ($this->direction) {
                $css .= sprintf($prefix . 'animation-direction: %s;', $this->direction);
            }
            if ($this->iterationCount) {
                $css .= sprintf($prefix . 'animation-iteration-count: %s;', $this->iterationCount);
            }
            if ($this->playState) {
                $css .= sprintf($prefix . 'animation-play-state: %s;', $this->playState);
            }
            if ($this->timingFunction) {
                $css .= sprintf($prefix . 'animation-timing-function: %s;', $this->timingFunction);
            }
            if ($this->fillMode) {
                $css .= sprintf($prefix . 'animation-fill-mode: %s;', $this->fillMode);
            }
        }
        return $css;
    }

    /**
     * @param mixed $name
     * @return Animation
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the delay for the the beginning of the animation sequence.
     *
     * @param float $delay Delay in seconds
     * @return Animation
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
        return $this;
    }

    /**
     * Set whether the animation should alternate its direction on each run through the sequence or reset to the start point and repeat itself.
     *
     * @param string $direction Example values: normal, reverse, alternate, alternate-reverse
     * @return Animation
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * Set what values are applied to the animated objects before and after the animation is executing.
     *
     * @param string $fillMode Example values: none, forwards, backwards, both
     * @return Animation
     */
    public function setFillMode($fillMode)
    {
        $this->fillMode = $fillMode;
        return $this;
    }

    /**
     * Set the number of times the animation should repeat.
     *
     * @param string $iterationCount Example values: infinite, 1, 2, ...
     * @return Animation
     */
    public function setIterationCount($iterationCount)
    {
        $this->iterationCount = $iterationCount;
        return $this;
    }

    /**
     * Set the initial play state (e.g. "paused", so the animation sequence can be resumed dynamically).
     *
     * @param string $playState Example values: paused, running
     * @return Animation
     */
    public function setPlayState($playState)
    {
        $this->playState = $playState;
        return $this;
    }

    /**
     * Set the timing of the animation (i.e. how the animation transitions through keyframes)
     *
     * @param string $timingFunction Example values: ease, ease-in, ease-out, ease-in-out, linear, step-start, step-end, steps(5, end), cubic-bezier(0.2, 0.9, 0.8, 0.1)
     * @return Animation
     */
    public function setTimingFunction($timingFunction)
    {
        $this->timingFunction = $timingFunction;
        return $this;
    }

} 
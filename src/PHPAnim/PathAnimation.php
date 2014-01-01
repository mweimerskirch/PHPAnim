<?php

namespace PHPAnim;

class PathAnimation extends Animation
{

    /**
     * @param string $svgPath
     * @param float $speed pixels per second
     * @param float $delay
     * @param float $scale
     * @throws \Exception
     */
    function __construct($svgPath, $speed = 50, $delay = 0.0, $scale = 1.0)
    {
        parent::__construct($delay);
        $points = explode(' ', $svgPath);
        $prev_x = 0;
        $prev_y = 0;
        $mode = 'M';
        $mode_absolute = true;

        $i = 0;
        foreach ($points as $point) {
            $point = trim($point);

            /*
             * M = moveto
             * L = lineto
             * H = horizontal lineto
             * V = vertical lineto
             * C = curveto
             * S = smooth curveto
             * Q = quadratic Bézier curve
             * T = smooth quadratic Bézier curveto
             * A = elliptical Arc
             * Z = closepath
             * All of the commands above can also be expressed with lower letters.
             * Capital letters means absolutely positioned, lower cases means relatively positioned.
             */
            if (strlen($point) == 1) {
                if (in_array($point, ['M', 'm'])) {
                    $mode = $point;
                } else {
                    throw new \Exception(sprintf('SVG mode %s not yet supported', $point));
                }
                $mode_absolute = in_array($point, ['M', 'L', 'H', 'V', 'C', 'S', 'Q', 'T', 'A', 'Z']);
            } else {
                $i++;
                list($x, $y) = explode(',', $point);
                $x = floatval($x) * $scale;
                $y = floatval($y) * $scale;

                if ($i == 1) {
                    $duration = 0;
                } else {
                    $distance_x = abs($prev_x - $x);
                    $distance_y = abs($prev_y - $y);
                    $distance = $distance_x + $distance_y; //FIXME
                    $duration = $distance / $speed;
                }

                if (!$mode_absolute) {
                    $x = $prev_x + $x;
                    $y = $prev_y + $y;
                }
                $this->addKeyframe(new Keyframe($duration, [
                    'left' => intval($x) . 'px',
                    'bottom' => intval($y) . 'px',
                ]));
                $prev_x = $x;
                $prev_y = $y;
            }
        }
    }

}
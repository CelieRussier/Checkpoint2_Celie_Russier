<?php

namespace App\Service;

class Container
{
    public function inbox(int $numberCake): array
    {
        $smallBoxes = 0;
        $mediumBoxes = 0;
        $largeBoxes = 0;
        $numberOfBoxes = [$smallBoxes, $mediumBoxes, $largeBoxes];
        if ($numberCake < 3) {
            $smallBoxes = 1;
        }
        if ($numberCake < 6 && $numberCake > 2) {
            $mediumBoxes = 1;
        }
        if ($numberCake > 5 && $numberCake < 9) {
            $largeBoxes = 1;
        }
        if ($numberCake > 8) {
            $largeBoxes = (int) ($numberCake / 8);
            $additionalCakes = $numberCake % 8;
            $mediumBoxes = (int) ($additionalCakes / 5);
            // time'sup :(
        }
        return $numberOfBoxes;
    }
}

<?php


namespace SidSpears;


class AeolianMode  implements ModeInterface
{
    /**
     * @return array
     */
    public function getSteps(): array
    {
        return [2, 1, 2, 2, 1, 2, 2];
    }
}
<?php

namespace SidSpears;


class MusicScale
{
    const IONIAN = 'major';
    const AEOLIAN = 'minor';

    protected $AllNotes = [
        0 => 'C',
        1 => 'С# / Db',
        2 => 'D',
        3 => 'D# / Eb',
        4 => 'E',
        5 => 'F',
        6 => 'F# / Gb',
        7 => 'G',
        8 => 'G# / Ab',
        9 => 'A',
        10 => 'A# / Bb',
        11 => 'B',
    ];

    protected $scale;
    protected $mode;

    protected $notes = [];

    /**
     * Scale constructor.
     * @param $scale
     * @param $mode
     */
    public function __construct($scale, $mode)
    {
        $this->scale = $scale;
        $this->mode = $mode;
    }

    protected function generateNotes()
    {
        if ($this->mode === self::IONIAN) {
            $mapping = [2, 2, 1, 2, 2, 2, 1];
        } elseif ($this->mode === self::AEOLIAN) {
            $mapping = [2, 1, 2, 2, 1, 2, 2];
        }

        $currentKey = null;
        for ($i = 0; $i <= 6; $i++) {
            if ($i === 0) {
                $currentKey = array_search($this->scale, $this->AllNotes);
                $this->notes[] = $this->AllNotes[$currentKey];
            } else {
                $step = $mapping[$i - 1];
                $currentKey += $step;

                if ($currentKey > 11) {
                    $currentKey -= 12;
                }

                $this->notes[] = $this->AllNotes[$currentKey];
            }
        }

    }

    public function getNotes()
    {
        if (empty($this->notes)) {
            $this->generateNotes();
        }

        return $this->notes;
    }
}
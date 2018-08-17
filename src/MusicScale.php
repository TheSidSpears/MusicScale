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
     * @param string $scale
     * @param string $mode
     * @throws \Exception
     */
    public function __construct(string $scale, string $mode)
    {
        $this->setScale($scale);
        $this->mode = $this->getMode($mode);
    }

    /**
     * @param string $scale
     * @throws \Exception
     */
    protected function setScale(string $scale)
    {
        if (!in_array($scale,$this->AllNotes)){
            throw new \Exception('Unknown scale');
        }
        $this->scale = $scale;
    }

    /**
     * @param string $mode
     * @return ModeInterface
     * @throws \Exception
     */
    protected function getMode(string $mode): ModeInterface
    {
        switch ($mode) {
            case self::IONIAN:
                return new IonianMode();
            case self::AEOLIAN:
                return new AeolianMode();
            default :
                throw new \Exception('Unknown mode');
        }
    }

    protected function generateNotes()
    {
        $steps = $this->mode->getSteps();

        $currentKey = null;
        for ($i = 0; $i <= 6; $i++) {
            if ($i === 0) {
                $currentKey = array_search($this->scale, $this->AllNotes);
                $this->notes[] = $this->AllNotes[$currentKey];
            } else {
                $step = $steps[$i - 1];
                $currentKey += $step;

                if ($currentKey > 11) {
                    $currentKey -= 12;
                }

                $this->notes[] = $this->AllNotes[$currentKey];
            }
        }

    }

    /**
     * @return array
     */
    public function getNotes()
    {
        if (empty($this->notes)) {
            $this->generateNotes();
        }

        return $this->notes;
    }
}
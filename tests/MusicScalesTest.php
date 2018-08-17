<?php

use SidSpears\MusicScale;
use PHPUnit\Framework\TestCase;

class MusicScalesTest extends TestCase
{
    /**
     * @dataProvider getNotesDataProvider
     * @param string $scale
     * @param string $mode
     * @param array $expectedResult
     * @throws Exception
     */
    public function testGetNotes(string $scale, string $mode, array $expectedResult)
    {
        $musicScales = new MusicScale($scale, $mode);

        $this->assertSame(
            $expectedResult,
            $musicScales->getNotes()
        );
    }

    public function getNotesDataProvider()
    {
        return [
            'major' => [
                'scale' => 'C',
                'mode' => MusicScale::IONIAN,
                'expected_result' => ['C', 'D', 'E', 'F', 'G', 'A', 'B']
            ],
            'minor' => [
                'scale' => 'E',
                'mode' => MusicScale::AEOLIAN,
                'expected_result' => ['E', 'F# / Gb', 'G', 'A', 'B', 'C', 'D']
            ]
        ];
    }

    /**
     * @dataProvider getNotesExceptionDataProvider
     * @param string $scale
     * @param string $mode
     * @throws Exception
     */
    public function testGetNotesException(string $scale, string $mode)
    {
        $this->expectException(Exception::class);
        new MusicScale($scale, $mode);
    }

    public function getNotesExceptionDataProvider()
    {
        return [
            'unknown scale' => [
                'scale' => 'Do',
                'mode' => MusicScale::IONIAN
            ],
            'unknown mode' => [
                'scale' => 'C',
                'mode' => 'Phyrigan'
            ]
        ];

    }
}
<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class SampleFileExport implements FromArray
{
    public function array(): array
    {
        return [
            ['Game Name', 'Username', 'Password'], // Header row
            ['Sample Game', 'sampleuser1', 'samplepass1'],
            ['Sample Game', 'sampleuser2', 'samplepass2'],
        ];
    }
}

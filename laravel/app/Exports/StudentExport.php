<?php

namespace App\Exports;

use App\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// class StudentExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Students::all();
//     }
// }


class StudentExport implements WithDrawings
{
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/logo.jpg'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B3');

        $drawing2 = new Drawing();
        $drawing2->setName('Other image');
        $drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('/img/other.jpg'));
        $drawing2->setHeight(120);
        $drawing2->setCoordinates('G2');

        return [$drawing, $drawing2];
    }
}

// <?php

// namespace App\Exports;

// use App\Students;
// use Maatwebsite\Excel\Concerns\FromArray;

// class StudentExport implements FromArray
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function array(): array
//     {
//         return [
//             [1, 2, 3],
//             [4, 5, 6]
//         ];
//     }
// }

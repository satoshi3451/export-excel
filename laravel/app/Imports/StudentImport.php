<?php

namespace App\Imports;

use App\Students;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable; //追加
use Maatwebsite\Excel\Concerns\WithHeadingRow; //追加

class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Students([
            'name'                => $row['name'],
            'grade'            => $row['grade'],
            'math'                   => $row['math'],
            'japanese'              => $row['japanese'],
            'english'               => $row['english'],
        ]);
    }

    public function chunkSize():int{
        return 50;
    }

}
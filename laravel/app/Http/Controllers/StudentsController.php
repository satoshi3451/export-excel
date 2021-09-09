<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class StudentsController extends Controller
{
    public function import(Request $request){
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        Excel::import(new StudentImport, $excel_file);
        return view('index');
    }

    public function export(){ //追加
        return Excel::download(new StudentExport, 'output_student_data.xlsx');


        // // テンプレートへのパス 
        // $template = "{{ asset('images/temp.xlsx')}}" ;
        // // 出力したいデータ
        // $data = [
        //     'name' => 'gorilla',
        //     'birth' => '1993-01-01',
        // ];

        // Excel::import($template, function($excel) use ($data){
        //     $excel->sheet('sheet1', function($sheet) use($data) {
        //         // $sheet->cell('出力したいセル位置', '出力したい値');
        //         $sheet->cell('C25', $data['name']);
        //         $sheet->cell('C27', date('Y年n月j日', strtotime($data['birth'])));
        //     });
        // })->setFilename("任意のファイル名")->export('xlsx');

        // Excel::import($this->edit($data),$template);
    }

    public function edit($data){
        $data = [
            'name' => 'gorilla',
            'birth' => '1993-01-01',
        ];

        // dd('text');

        $excel->sheet('sheet1', function($sheet) use($data) {
            // $sheet->cell('出力したいセル位置', '出力したい値');
            $sheet->cell('C25', $data['name']);
            $sheet->cell('C27', date('Y年n月j日', strtotime($data['birth'])));
        });

    }

}


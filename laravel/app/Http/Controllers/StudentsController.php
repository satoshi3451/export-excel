<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;    

class StudentsController extends Controller
{
    public function import(Request $request){
        $excel_file = $request->file('excel_file');
        $excel_file->store('excels');
        Excel::import(new StudentImport, $excel_file);
        return view('index');
    }

    public function export(){ //追加
        // return Excel::download(new StudentExport, 'output_student_data.xlsx');


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

        $spreadsheet = new Spreadsheet();

        // //ファイルの読み込み
        // $filePath = public_path('/images/休暇申請.xlsx');
        // $reader = new XlsxReader();
        // $spreadsheet = $reader->load($filePath);
        


        // //シートを指定して入力
        // $worksheet = $spreadsheet->getSheetByName('休暇届');
        // $worksheet->setCellValue('C7', 'とくになし');
        // $worksheet->setCellValue('L7', '山田太郎');
        // $worksheet->setCellValue('F24', 'ねむいので');


        //ファイルの読み込み
        $filePath = public_path('/images/購買稟議書01.xlsx');
        $reader = new XlsxReader();
        $spreadsheet = $reader->load($filePath);
        


        //シートを指定して入力
        $worksheet = $spreadsheet->getSheetByName('購買稟議書');
        $worksheet->setCellValue('E12', 'mac book pro 購入');
        $worksheet->setCellValue('E13', '仕事の為');
        $worksheet->setCellValue('E14', 'mac book pro');
        $worksheet->setCellValue('E15', 'windowsだと動かないコマンドが多すぎるから');
        $worksheet->insertNewRowBefore(13);
        $worksheet->insertNewRowBefore(13);
        $worksheet->setCellValue('E13', 'ここ行ふやしたよ');

        $i=0;
        $i++;
        $i++;
        $worksheet->insertNewRowBefore(19+$i);
        $worksheet->setCellValue('E'.(19+$i), 'ここ行ふやしたよ');




        //ブラウザでダウンロード
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');


        exit;

        // dd($spreadsheet);
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


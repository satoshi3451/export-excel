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
        $filePath = public_path('/images/一般媒介契約書_edit.xlsx');
        $reader = new XlsxReader();
        $spreadsheet = $reader->load($filePath);

        

        $arrays=[
            ['（目的）','この約款は、宅地又は建物の売買又は交換の一般媒介契約について、当事者が契約の締結に際して定めるべき事項及び当事者が契約の履行に関して互いに遵守すべき事項を明らかにすることを目的とします。','3','1'],
            ['(当事者の表示と用語の定義)','一.この約款においては、媒介契約の当事者について、依頼者を「甲」、依頼を受ける宅地建物取引業者を「乙」と表示します。二. この約款において、「一般媒介契約」とは、甲が依頼の目的である宅地又は建物(以下「目的物件」といいます。)の売買又は交換の媒介又は代理を乙以外の宅地建物取引業者に重ねて依頼することができるものとする媒介契約をいいます。','5','1'],
            ['(目的物件の表示等)','目的物件を特定するために必要な表示及び目的物件を売買すべき価額又は交換すべき評価額(以下「媒介価額」といいます。)は、一般媒介契約書の別表に記載します。','4','1'],
            ['(重ねて依頼をする宅地建物取引業者の明示)','一.甲は、目的物件の売買又は交換の媒介又は代理を乙以外の宅地建物取引業者に重ねて依頼するときは、その宅地建物取引業者を乙に明示しなければなりません。
            二.一般媒介契約の締結時においてすでに依頼をしている宅地建物取引業者の商号又は名称及び主たる事務所の所在地は、一般媒介契約書に記載するものとし、その後において更に他の宅地建物取引業者に依頼をしようとするときは、甲は、その旨を乙に通知するものとします。','5','1'],
            ['(宅地建物取引業者の業務)','乙は、契約の相手方との契約条件の調整等を行い、契約の成立に向けて努力するとともに、次の業務を行います。
            一. 媒介価額の決定に際し、甲に、その価額に関する意見を述べるときは、根拠を示して説明を行うこと。
            二.甲が乙に目的物件の購入又は取得を依頼した場合にあっては、甲に対して、目的物件の売買又は交換の契約が成立するまでの間に、宅地建物取引士をして、宅地建物取引業法第35条に定める重要事項について、宅地建物取引士が記名押印した書面を交付して説明させること。
            三.目的物件の売買又は交換の契約が成立したときは、甲及び甲の相手方に対して、遅滞なく、宅地建物取引業法第37条に定める書面を作成し、宅地建物取引士に当該書面に記名押印させた上で、これを交付すること。
            四.甲に対して、登記、決済手続等の目的物件の引渡しに係る事務の補助を行うこと。
            五.その他一般媒介契約書に記載する業務を行うこと。','11','1'],
            ['(媒介価額の変更の助言等)','一.媒介価額が地価や物価の変動その他事情の変更によって不適当と認められるに至ったときは、乙は、甲に対して、媒介価額の変更について根拠を示して助言します。
                二.甲は、媒介価額を変更しようとするときは、乙にその旨を通知します。この場合において、価額の変更が引上げであるとき(甲が乙に目的物件の購入又は取得を依頼した場合にあっては、引下げであるとき)は、乙の承諾を要します。
                三. 乙は、前項の承諾を拒否しようとするときは、その根拠を示さなければなりません。','9','1'],
            ['(有効期間)','一般媒介契約の有効期間は、3ケ月を超えない範囲で、甲乙協議の上、定めます。','2','1'],
            ['(指定流通機構への登録)','乙は、この媒介契約において目的物件を指定流通機構に登録することとした場合にあっては、当該目的物件を一般媒介契約書に記載する指定流通機構に登録しなければなりません。','3','1'],
            ['(報酬の請求)','"一.乙の媒介によって目的物件の売買又は交換の契約が成立したときは、乙は、甲に対して、報酬を請求することができます。ただし、売買又は交換の契約が停止条件付契約として成立したときは、乙は、その条件が成就した場合にのみ報酬を請求することができます。
            二.前項の報酬の額は、国土交通省告示に定める限度額の範囲内で、甲乙協議の上、定めます。" ','6','1'],
            ['(報酬の受領の時期)','一.乙は、宅地建物取引業法第37条に定める書面を作成し、これを成立した契約の当事者に交付した後でなければ、前条第1項の報酬(以下「約定報酬」といいます。)を受領することができません。
            二.目的物件の売買又は交換の契約が、代金又は交換差金についての融資の不成立を解除条件として締結された後、 融資の不成立が確定した場合、又は融資が不成立のときは甲が契約を解除できるものとして締結された後、融資の 不成立が確定し、これを理由として甲が契約を解除した場合は、乙は、甲に受領した約定報酬の全額を遅滞なく返還しなければなりません。ただしこれに対しては利息は付さないこととします。','7','1'],
            ['(特別依頼に係る費用)','甲が乙に特別に依頼した広告の料金又は遠隔地への出張旅費は甲の負担とし、甲は、乙の請求に基づいて、その実費を支払わなければなりません。','2','1'],
            ['(直接取引)','一般媒介契約の有効期間内又は有効期間の満了後2年以内に、甲が乙の紹介によって知った相手方と乙を排除して目的物件の売買又は交換の契約を締結したときは、乙は、甲に対して、契約の成立に寄与した割合に応じた相当額の報酬を請求することができます。','3','1'],
            ['(費用償還の請求)','一.一般媒介契約の有効期間内に甲が乙に明示していない宅地建物取引業者に目的物件の売買又は交換の媒介又は代理を依頼し、これによって売買又は交換の契約を成立させたときは、乙は、甲に対して、一般媒介契約の履行のために要した費用の償還を請求することができます。
            二.前項の費用の額は、約定報酬額を超えることはできません。','4','1'],
            ['(依頼者の通知義務)','一.甲は、一般媒介契約の有効期間内に、自ら発見した相手方と目的物件の売買若しくは交換の契約を締結したとき、又は乙以外の宅地建物取引業者の媒介若しくは代理によって目的物件の売買若しくは交換の契約を成立させたときは、乙に対して遅滞なくその旨を通知しなければなりません。
            二.甲が前項の通知を怠った場合において、乙が売買又は交換の契約の成立後善意で甲のために一般媒介契約の事務の処理に要する費用を支出したときは、乙は、甲に対して、その費用の償還を請求することができます。','7','1'],
            ['(更 新)','一.一般媒介契約の有効期間は、甲及び乙の合意に基づき、更新することができます。
            二.有効期間の更新をしようとするときは、有効期間の満了に際して甲から乙に対し文書でその旨を申し出るものとします。
            三.前2項の規定による有効期間の更新に当たり、甲乙間で一般媒介契約の内容について別段の合意がなされなかったときは、従前の契約と同一内容の契約が成立したものとみなします。','5','1'],
            ['(契約の解除)','甲又は乙が一般媒介契約に定める義務の履行に関してその本旨に従った履行をしない場合には、その相手方は、相当の期間を定めて履行を催告し、その期間内に履行がないときは、一般媒介契約を解除することができます。','4','1'],
            ['(特 約)','一.この約款に定めがない事項については、甲及び乙が協議して別に定めることができます。
            二.この約款の各条項の定めに反する特約で甲に不利なものは無効とします。','4','1'],
        ];

        // dd($array,$array[0]);
        //シートを指定して入力
        $worksheet = $spreadsheet->getSheetByName('媒介契約書');

        // $dpoint_x='AJ';
        $default_x=36;
        $default=3;
        $Article_count=1;


        $dpoint_x=$default_x;
        $dpoint_y=$default;
        //columnIndexFromString//列アルファベットから列番号に変換する
        //stringFromColumnIndex//列番号から列アルファベットに変換する

        // dd(Coordinate::columnIndexFromString('AY'));
        // dd(Coordinate::stringFromColumnIndex($dpoint_x));

        foreach($arrays as $array){
            if($array[3]==1){
                if(58<$dpoint_y+$array[2]+1){
                    $dpoint_x=51;
                }
                $worksheet->setCellValue(Coordinate::stringFromColumnIndex($dpoint_x).$dpoint_y, $array[0]);
                $worksheet->mergeCellsByColumnAndRow($dpoint_x, $dpoint_y, $dpoint_x+14, $dpoint_y);
                $worksheet->setCellValue(Coordinate::stringFromColumnIndex($dpoint_x+1).($dpoint_y+1), "第${Article_count}条");
                $worksheet->setCellValue(Coordinate::stringFromColumnIndex($dpoint_x+2).($dpoint_y+1), $array[1]);
                // $sheet->mergeCells('AL4:AM4');
                $worksheet->mergeCellsByColumnAndRow($dpoint_x+2, $dpoint_y+1, $dpoint_x+14, $dpoint_y+$array[2]);


                //最後にまとめて更新
                $Article_count++;
                $dpoint_y=$dpoint_y+1+$array[2];
            };
        }


        // $worksheet->setCellValue('E15', 'windowsだと動かないコマンドが多すぎるから');
        // $worksheet->insertNewRowBefore(13);
        // $worksheet->insertNewRowBefore(13);
        // $worksheet->setCellValue('E13', 'ここ行ふやしたよ');

        // $i=0;
        // $i++;
        // $i++;
        // $worksheet->insertNewRowBefore(19+$i);
        // $worksheet->setCellValue('E'.(19+$i), 'ここ行ふやしたよ');




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


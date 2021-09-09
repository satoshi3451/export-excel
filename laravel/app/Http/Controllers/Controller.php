<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Students;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 帳票のエクスポート
     */
    public function export()
    {
        $users = User::with('company.companyType', 'role')->get();
        $view = \view('users.export', compact($users));
        return \Excel::download(new Export($view), 'users.xlsx');
    }

    public function index(){
        // dd('sya');
        $students = Students::all();
        return view('index',['students' => $students]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class ItdController extends Controller
{
    public function showDashboard()
    {
        $activeUsers = User::where('userStatusID', 1)->count();
        $inActiveUsers = User::where('userStatusID', 2)->count();
        $archivedUsers = User::where('userStatusID', 3)->count();
        $userRs = array('userrole' => DB::table('userrole')->get());
        $userSs = array('userstatus' => DB::table('userstatus')->where('userStatusID', '!=', 3)->get());
        $userDs = array('department' => DB::table('department')->get());
        return view('pages.itd.users', compact('activeUsers','inActiveUsers', 'archivedUsers','userRs','userSs','userDs'));
    }
}

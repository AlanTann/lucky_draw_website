<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Services\LuckyDrawService;
use View;

class LuckyDrawController extends Controller
{
    public function drawWinner(Request $req)
    {
        $lucky_draw_service = New LuckyDrawService();

        $admin_id = $req->user()->id;

        $admin_exist = $this->checkIfUserIsAdmin($admin_id);

        if($admin_exist == 0)
        {
            return redirect('/result');
        }

        $response = $lucky_draw_service->drawWinner($req);

        return View::make('admin', ['result' => $response]);
    }

    public function checkIfUserIsAdmin($user_id)
    {
        $admin = new Admin();
        $count_winner_exist = $admin->where('user_id','=', $user_id)->get()->count();

        return $count_winner_exist;
    }

    public function showMember(Request $req)
    {
        $member_id = $req->user()->id;

        $lucky_draw_service = New LuckyDrawService();
        $user_lucky_info = $lucky_draw_service->getListOfLuckyNumberUser($member_id)->toArray();

        // show the form
        return View::make('member', ['user_lucky_info' => $user_lucky_info]);
    }

    public function showResult ()
    {
        $lucky_draw_service = New LuckyDrawService();
        $winning_result = $lucky_draw_service->getWinnerName();

        // show the form
        return View::make('result', ['winningResult' => $winning_result]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use View;

class AdminController extends Controller
{
    public function showAdmin (Request $req)
    {
        $admin_id = $req->user()->id;

        $admin_exist = $this->checkIfUserIsAdmin($admin_id);

        if($admin_exist == 0)
        {
            return redirect('/result');
        }

        // show the form
        return View::make('admin');
    }

    public function checkIfUserIsAdmin($user_id)
    {
        $admin = new Admin();
        $count_winner_exist = $admin->where('user_id','=', $user_id)->get()->count();

        return $count_winner_exist;
    }

}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\WinningResult;
use App\Models\UserWinningNumber;
use App\Models\Admin;
use View;
use Carbon\Carbon;
use DB;
use Response;

class LuckyDrawService
{

    public function __construct()
    {
    }

    public function drawWinner(Request $req)
    {
        $prize_type = $req->input('prize_type');
        $random = $req->input('random');
        if($req->has('lucky_number')) {
            $winning_number = $req->input('lucky_number');
        }
        
        if($random == "no") {
            if($winning_number) {
                $user_id = $this->getUserOfLuckyNumber($winning_number);
                if(!$user_id) {
                    return 'This lucky number does not belong to any user.';
                }
            } else {
                return 'Please Insert a winning number.';
            }

            $user_winner = $this->checkIfUserIsWinner($winning_number);
            if($user_winner > 0) {
                return 'This user already had a prize';
            }
            $clean_result = $this->cleanSpecificUserPrize($prize_type);
            $winner_result = $this->insertWinner($prize_type, $winning_number);
            $update_user_result = $this->updateUserWinningNumber($prize_type, $winning_number);
            return 'Draw Successful. Winning Number for '.$prize_type.': '.$winning_number;
        }

        if($prize_type == "grand_winner") {
            $user_id_array = $this->getHighestWinningNumberUser();
            $winning_number = $this->drawGrandRandomNumber($user_id_array);
        } else {
            $winning_number = $this->drawRandomNumber();
        }

        //Insert Winner
        $clean_result = $this->cleanSpecificUserPrize($prize_type);
        $update_user_result = $this->updateUserWinningNumber($prize_type, $winning_number);
        $winner_result = $this->insertWinner($prize_type, $winning_number);

        return 'Draw Random Successful. Winning Number for '.$prize_type.': '.$winning_number;
    }

    public function checkIfUserIsAdmin($user_id)
    {
        $admin = new Admin();
        $count_winner_exist = $admin->where('user_id','=', $user_id)->get()->count();

        return $count_winner_exist;
    }

    public function checkIfUserIsWinner($lucky_number)
    {
        $user_id = $this->getUserOfLuckyNumber($lucky_number);

        $user_winning_number = new UserWinningNumber();
        $count_winner_exist = $user_winning_number->where('user_id', $user_id)->where('prize','!=', '')->get()->count();

        return $count_winner_exist;
    }

    public function getUserOfLuckyNumber($lucky_number)
    {
        $user_winning_number = new UserWinningNumber();
        $user = $user_winning_number->select('user_id')->where('lucky_number','=', $lucky_number)->get()->toArray();

        if($user) {
            return $user[0]['user_id'];
        }

        return false;
    }

    public function updateUserWinningNumber($prize_type, $lucky_number)
    {
        $user_winning_number = new UserWinningNumber();
        $lucky_number_data = $user_winning_number->where('lucky_number', $lucky_number)->update(array('prize'=>$prize_type));

        return $lucky_number_data;
    }

    public function getHighestWinningNumberUser()
    {
        $max_user_result = DB::select(DB::Raw('Select MAX(user_count) as max_user FROM ( select user_id, count(user_id) user_count from user_winning_number group by user_iD ) as t2'));
        $user_id_result = DB::select(DB::Raw('Select user_id FROM ( select user_id, count(user_id) user_count from user_winning_number group by user_iD ) as ts where user_count = '. $max_user_result[0]->max_user));

        $user_array = array();
        foreach($user_id_result as $user_id_key) {
            array_push($user_array, $user_id_key->user_id);
        }

        return $user_array;
    }

    public function drawGrandRandomNumber(array $user_id_array)
    {
        $user_winning_number = new UserWinningNumber();
        $lucky_number_data = $user_winning_number->select('lucky_number')->whereIn('user_id',$user_id_array)->get();
        $lucky_number_array = $lucky_number_data->toArray();
        $lucky_number_point = array_rand($lucky_number_array,1);
        $winning_number = $lucky_number_array[$lucky_number_point]['lucky_number'];

        return $winning_number;
    }

    public function getCurrentWinner()
    {
        $user_winning_number = new UserWinningNumber();
        $winner_user = $user_winning_number->select('user_id')->where('prize','!=', '')->get();

        return $winner_user;
    }

    public function drawRandomNumber()
    {
        $winner_user = $this->getCurrentWinner()->toArray();

        $user_winning_number = new UserWinningNumber();
        $lucky_number_data = $user_winning_number->select('lucky_number')->where('prize','=', '')->whereNotIn('user_id', $winner_user)->get();
        $lucky_number_array = $lucky_number_data->toArray();
        $lucky_number_point = array_rand($lucky_number_array,1);
        $winning_number = $lucky_number_array[$lucky_number_point];

        return $winning_number;
    }

    public function getWinnerResult()
    {
        $winner_result = new WinningResult();
        $lucky_number_data = $winner_result->orderby('created_date','DESC')->limit(1)->get();

        return $lucky_number_data;
    }

    public function insertWinner($prize_type, $winning_number)
    {
        $winner_data = $this->getWinnerResult()->toArray();

        $winning_result = New WinningResult();
        if($winner_data) {
            $winning_data = $winning_result->find($winner_data[0]['id']);
            $winning_data->created_date= $winner_data[0]['created_date'];
        } else {
            $winning_data = New WinningResult();
            $winning_data->created_date = Carbon::Now();
        }

        if($prize_type == "grand_winner") {
            $winning_data->grand_winner = $winning_number;
        } elseif($prize_type == "second_first_winner") {
            $winning_data->second_first_winner = $winning_number;
        } elseif($prize_type == "second_second_winner") {
            $winning_data->second_second_winner = $winning_number;
        } elseif($prize_type == "third_first_winner") {
            $winning_data->third_first_winner = $winning_number;
        } elseif($prize_type == "third_second_winner") {
            $winning_data->third_second_winner = $winning_number;
        } elseif($prize_type == "third_third_winner") {
            $winning_data->third_third_winner = $winning_number;
        }

        $winning_data->updated_date= Carbon::Now();
        $winning_save = $winning_data->save();

        return $winning_save;
    }

    public function cleanSpecificUserPrize(string $prize_type) {
        $user_winning_number = new UserWinningNumber();
        $clean_result = $user_winning_number->where('prize', $prize_type)->update(array('prize'=>''));

        return $clean_result;
    }

    public function getWinnerName()
    {
        $winning_result = $this->getWinnerResult()->toArray();
        $winner_result_data = $winning_result[0];
    
        $winner_name = array();
        $winner_name['grand_winner'] = $this->getWinnerNameQuery($winner_result_data['grand_winner'])->name;
        $winner_name['second_first_winner'] = $this->getWinnerNameQuery($winner_result_data['second_first_winner'])->name;
        if(isset($winner_result_data['grand_winner'])) {
            $winner_name['grand_winner'] = $this->getWinnerNameQuery($winner_result_data['grand_winner'])->name;
        }
        if(isset($winner_result_data['second_first_winner'])) {
            $winner_name['second_first_winner'] = $this->getWinnerNameQuery($winner_result_data['second_first_winner'])->name;
        }
        if(isset($winner_result_data['second_second_winner'])) {
            $winner_name['second_second_winner'] = $this->getWinnerNameQuery($winner_result_data['second_second_winner'])->name;
        }
        if(isset($winner_result_data['third_first_winner'])) {
            $winner_name['third_first_winner'] = $this->getWinnerNameQuery($winner_result_data['third_first_winner'])->name;
        }
        if(isset($winner_result_data['third_second_winner'])) {
            $winner_name['third_second_winner'] = $this->getWinnerNameQuery($winner_result_data['third_second_winner'])->name;
        }
        if(isset($winner_result_data['third_third_winner'])) {
            $winner_name['third_third_winner'] = $this->getWinnerNameQuery($winner_result_data['third_third_winner'])->name;
        }

        return $winner_name;
    }

    public function getWinnerNameQuery($lucky_number) 
    {
        $users = DB::table('user_winning_number')
            ->select('users.name')
            ->join('users', 'users.id', '=', 'user_winning_number.user_id')
            ->where('user_winning_number.lucky_number', $lucky_number)
            ->get()
            ->toArray();

        if(!$users) {
            return '';
        }
        
        return $users[0];
    }

    public function getListOfLuckyNumberUser($user_id)
    {
        $user_winning_number = new UserWinningNumber();
        $user_winning_info = $user_winning_number->where('user_id', $user_id)->get();

        return $user_winning_info;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WinningResult extends Model
{
    protected $table = 'winner_result';

    public $timestamps = false;

    public $primaryKey = 'id';

    protected $fillable = ['grand_winner', 'second_first_winner', 'second_second_winner', 'third_first_winner', 
    'third_second_winner', 'third_third_winner', 'round', 'created_date', 'updated_date'];
    
}

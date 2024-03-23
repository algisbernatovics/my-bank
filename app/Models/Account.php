<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function balance()
    {
        $independencys = (Transaction::where('to', '=', $this->acc_number)
            ->sum('converted_amount'));

        $expenses = (Transaction::where('from', '=', $this->acc_number)
            ->sum('transfer_amount'));

        $this->funds = ($independencys - $expenses);
        return $this->funds;
    }
}

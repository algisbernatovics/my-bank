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

        return $this->funds  / 100;
    }


    public function independencys()
    {
        return $this->hasMany(Transaction::class, 'from', 'acc_number');
    }

    public function expenses()
    {
        return $this->hasMany(Transaction::class, 'to', 'acc_number');
    }
    public function getAllTransactions()
    {
        $independencys = $this->independencys;
        $expenses = $this->expenses;

        return $independencys->merge($expenses)->sortByDesc('created_at');
    }


}

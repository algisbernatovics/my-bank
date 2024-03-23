<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    public function senderAcc()
    {
        return $this->belongsTo(Account::class, 'to', 'acc_number');
    }

    public function receiverAcc()
    {
        return $this->belongsTo(Account::class, 'from', 'acc_number');
    }
}

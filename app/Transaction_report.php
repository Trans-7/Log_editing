<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_report extends Model
{
    protected $connection = 'sqlsrv';
    public $incrementing = true;
    protected $table = 'transaction_logeditingreport';
    protected $hidden = ['logeditingreport_id'];
}

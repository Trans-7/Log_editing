<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_logeditingpriviledge extends Model
{
    protected $connection = 'sqlsrv';
    public $incrementing = true;
    protected $table = 'transaction_logeditingpriviledge'; 
    protected $primaryKey = 'logeditingpriviledge_nik';
    protected $fillable = [
        'logeditingpriviledge_nik', 'logeditingpriviledge_name', 'logeditingpriviledge_level'
    ];
}

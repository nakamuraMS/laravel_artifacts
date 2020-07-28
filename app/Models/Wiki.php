<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    const DISP_ON = 1;
    const DISP_OFF = 2;
    const UPLOAD_PASS = 'public/wiki/';
    const STORAGE_PASS = 'storage/wiki/';

    const DISP = [
        self::DISP_ON  => '公開',
        self::DISP_OFF => '非公開',
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'id'
    ];
}

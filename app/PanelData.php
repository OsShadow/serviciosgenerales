<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelData extends Model
{
    protected $casts = [
        
        'open' => 'type',
        'close'=> 'type',
    ];
}

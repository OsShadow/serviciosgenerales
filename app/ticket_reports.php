<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket_reports extends Model
{
    public function ticketStatus(){
        return $this->hasOne('App\TicketStatus', 'id', 'id_status');
    }
}

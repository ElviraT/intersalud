<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Nncodes\Meeting\Concerns\HostsMeetings;
use Nncodes\Meeting\Contracts\Host;

class Room extends Model implements Host
{
    use HostsMeetings;
}
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Nncodes\Meeting\Concerns\SchedulesMeetings;
use Nncodes\Meeting\Contracts\Scheduler;

class Event extends Model implements Scheduler
{
    use SchedulesMeetings;
}

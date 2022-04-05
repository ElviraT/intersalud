<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Nncodes\Meeting\Concerns\PresentsMeetings;
use Nncodes\Meeting\Contracts\Presenter;

class Teacher extends User implements Presenter
{
    use PresentsMeetings;
}

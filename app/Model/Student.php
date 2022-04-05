<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Nncodes\Meeting\Concerns\JoinsMeetings;
use Nncodes\Meeting\Contracts\Participant;

class Student extends User implements Participant
{
    use JoinsMeetings;

    /**
     * Email Address of the participant
     *
     * @return string
     */
    public function getParticipantEmailAddress(): string
    {
        return $this->email;
    }

    /**
     * First name of the participant
     *
     * @return string
     */
    public function getParticipantFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * Last name of the participant
     *
     * @return string
     */
    public function getParticipantLastName(): string
    {
        return $this->last_name;
    }
}
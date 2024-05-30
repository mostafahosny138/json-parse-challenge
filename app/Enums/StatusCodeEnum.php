<?php

namespace App\Enums;


use BenSampo\Enum\Enum;

class StatusCodeEnum extends Enum
{
    const AUTHORISED = 'authorised';
    const DECLINE = 'decline';
    const REFUNDED = 'refunded';


}

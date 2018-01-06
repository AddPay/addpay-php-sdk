<?php

require 'vendor/autoload.php';

class AddPayOpenAPI extends AddPay\Foundation\Protocol\API\OpenAPI {

    const STATE_READY                 = 'READY';
    const STATE_ACTIVE                = 'ACTIVE';
    const STATE_PARTIAL               = 'READY';
    const STATE_INVALID               = 'READY';
    const STATE_AVSPENDING            = 'AVSPENDING';
    const STATE_AVSSUBMITTED          = 'AVSSUBMITTED';
    const STATE_AVSFAILED             = 'AVSFAILED';
    const STATE_FAILED                = 'FAILED';
    const STATE_COMPLETED             = 'COMPLETE';
    const STATE_CANCELLED             = 'CANCELLED';
    const STATE_SECURE_AUTHED         = 'SECUREAUTHED';
    const STATE_SECURE_PENDING        = 'SECUREPENDING';
    const STATE_SECURE_AUTHED_FAILED  = 'SECUREAUTHFAILED';
    const STATE_SECURE_FAILED         = 'SECUREFAILED';

}

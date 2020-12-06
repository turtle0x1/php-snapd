<?php

namespace dhope0000\Snap\Exception;

use Exception;

class ClientConnectionException extends Exception
{
    protected $message = 'LXD client connection failed.';
}

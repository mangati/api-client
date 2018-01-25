<?php

namespace Mangati\Api;

use Exception;

/**
 * Session
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Session
{
    /**
     * @var array
     */
    public $headers;

    public function __construct()
    {
        $this->headers = [];
    }
}

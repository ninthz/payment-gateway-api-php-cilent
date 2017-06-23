<?php
/**
 * Created by PhpStorm.
 * User: nuttasaktawon
 * Date: 6/23/2017 AD
 * Time: 11:04 AM
 */

namespace PaymentGatewayClient\Exceptions;


class HostHandshakeFailed extends \Exception
{
    public function __construct($message = 'Can\'t connect with payment gateway host.', $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace Webkul\Chapa\Payment;

use Webkul\Payment\Payment\Payment;


class Chapa extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'chapa';

    public function getRedirectUrl()
    {

    }
}

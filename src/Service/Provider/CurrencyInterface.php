<?php

namespace App\Service\Provider;

interface CurrencyInterface
{
    /**
     * HTTP request sending for service.
     *
     * @return array
     */
    public function request();

    /**
     * Parse response.
     *
     * @return array
     */
    public function response();
}

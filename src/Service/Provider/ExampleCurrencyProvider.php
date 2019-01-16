<?php

namespace App\Service\Provider;

class ExampleCurrencyProvider implements CurrencyInterface
{
    /**
     * Currency provider (example:mocky.io-v1) endpoint url.
     *
     * @var string
     */
    private $urlProvider = 'http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0';

    /**
     * Request type.
     *
     * @var string
     */
    private $requestType = 'GET';

    /**
     * @var float
     */
    private $usd;

    /**
     * @var float
     */
    private $euro;

    /**
     * @var float
     */
    private $gbp;

    /**
     * Send request and complete the exchange import process.
     *
     * @return mixed
     */
    public function request()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request($this->requestType, $this->urlProvider);
        $result = json_decode($response->getBody()->getContents(), true);

        try {
            if ($response->getStatusCode() == 200) {
                foreach ($result as $currencyValue) {
                    $this->usd  = $this->currencySubArray('USDTRY', $currencyValue);
                    $this->euro = $this->currencySubArray('EURTRY', $currencyValue);
                    $this->gbp  = $this->currencySubArray('GBPTRY', $currencyValue);
                }
                return $this->response();
            } else {
                throw new Exception('Could not read endpoint from service provider');
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Finds the exchange rate in the service.
     *
     * @param  string $type
     * @param  array  $currencyValue
     * @return float
     */
    public function currencySubArray($type, $currencyValue)
    {
        foreach ($currencyValue as $subValue) {
            if ($type == $subValue['symbol']) {
                return $subValue['amount'];
            }
        }
    }

    /**
     * Send the response as an object.
     *
     * @return array
     */
    public function response()
    {
        return $currencyList = (object) [
            'usd'  => $this->usd,
            'euro' => $this->euro,
            'gbp'  => $this->gbp,
        ];
    }
}

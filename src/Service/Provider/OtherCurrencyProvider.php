<?php

namespace App\Service\Provider;

class OtherCurrencyProvider implements CurrencyInterface
{
    /**
     * Currency provider (other:mocky.io-v2) endpoint url.
     *
     * @var string
     */
    private $urlProvider = 'http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3';

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
                    switch ($currencyValue['kod']) {
                        case 'DOLAR':
                            $this->usd = $currencyValue['oran'];
                            break;
                        case 'AVRO':
                            $this->euro = $currencyValue['oran'];
                            break;
                        case 'İNGİLİZ STERLİNİ':
                            $this->gbp = $currencyValue['oran'];
                            break;
                    }
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

<?php
    namespace Bendzsi\Vote;

    use GuzzleHttp\Client; // outside API call

    class Requester {
        private $key;
        private $url;

        public function __construct($config){
            $this->key=$config['apiKey'];
            $this->url=$config['apiUrl'];
        }
        public function getRates($crypto,$currency){
            $client = new Client();
            $response = $client->request(
                'GET', $this->url . 'fysm= ' .$crypto . '&tsyms=' . $currency,
                [
                    'headers' => [
                        'Authorization' => 'Apikey' . $this->key
                ]
            ]);
            $rates = json_decode($response->getBody(), true); // remove body, decode it
            return $rates[$currency];
            //return $rates;

        }

     
    }
?>
<?php

namespace App\Http\Traits;

use Goutte\Client;


trait DollarExchangeTrait
{
    public function getCurrentExchange()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://www.bcv.org.ve/');
    
        $dolar_node = $website->filter('#dolar strong')->each(function ($node) {
            return $node->text();
        })[0];

        return floatval(number_format(str_replace(',', '.', $dolar_node), 2));
    }
}
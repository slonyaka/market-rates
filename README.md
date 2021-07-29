

Create an instance of MarketRate class  
set API key for Alpha Vantage service  


getCurrencyRates - method to get list of rates of one currency  
comparing to second one


getRates method returns a Collection of MarketData instances
currently works with https://www.alphavantage.co
and needs API Key from this service

```

$rates = Slonyaka\Market\CurrencyRateFactory::make('alpha_vantage_api_key');
$ratesCollection = $rates->getRates('usd', 'eur', '5min');

foreach ($ratesCollection->read() as $rate) {
    echo $rate->lowPrice;
}

```

MarketData from the collection could be iterated as items of DoublyLinked List


```
while($item->next) {
	echo $item->closePrice. "<br>";
	$item = $item->next;
}

```
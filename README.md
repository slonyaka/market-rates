

Create an instance of MarketRate class  
set API key for Alpha Vantage service  


getCurrencyRates - method to get list of rates of one currency  
comparing to second one


getRates method returns a Collection of MarketData instances


```

$rates = new Slonyaka\Market\CurrencyRate();
$rates->setApiKey('alpha_vantage_api_key');
$data = $rates->getRates('usd', 'eur', '5min');

```

MarketData from the collection could be iterated as items of DoublyLinked List


```
while($item->next) {
	echo $item->closePrice. "<br>";
	$item = $item->next;
}

```
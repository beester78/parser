<?php

declare(strict_types=1);

namespace App\Model;

use Elasticsearch\ClientBuilder;

class ElasticSearchRepository
{
	public function indexData($data)
	{
		$client = ClientBuilder::create()->build();

		$params = [
			'index' => 'ukol',
			'type' => 'article'
		];
		foreach ($data as $dataItem) {
			$client->index($params + ['body' => $dataItem]);
		}

//		$response = $client->get($params);
//		dump($client);
//		dumpe($response);
	}

}

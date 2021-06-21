<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Exceptions\ParserException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Parser
{
	/**
	 * @param $url
	 * @return string
	 * @throws GuzzleException
	 */
	public function downloadUrlContent($url): string
	{
		$client = new Client();
		$response = $client->request('GET', $url);
		return $response->getBody()->getContents();
	}

	public function parse($urlContent)
	{
		// search H3 block "Všechny funkce.." and use content for parsing after this block
		$splits = preg_split('#<h3>Všechny funkce(.*?)</h3>#is', $urlContent);
		if (!isset($splits[1])) {
			throw new ParserException('V URL obsahu nenalezen blok s daty');
		}

		// search all h4 (titles) and paragraphs (descriptions)
		preg_match_all('#<h4>(.*?)</h4>\s*<p>(.*?)</p>#is', $splits[1], $matches);

		// prepare data structure
		$data = [];
		foreach ($matches[1] as $key => $title) {
			$data[] = ['title' => $title, 'description' => $matches[2][$key]];
		}

		// no title & desc?
		if (!$data) {
			throw new ParserException('V URL obsahu nenalezeny žádné nadpisy a popisky');
		}

		return $data;
	}
}


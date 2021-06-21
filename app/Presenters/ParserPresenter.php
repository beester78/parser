<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\DatabaseRepository;
use App\Model\ElasticSearchRepository;
use App\Model\Exceptions\ParserException;
use App\Model\Parser;
use Elasticsearch\ClientBuilder;
use GuzzleHttp\Exception\GuzzleException;
use Nette\Utils\ArrayHash;

final class ParserPresenter extends BasePresenter
{
	/** @var Parser @inject */
	public $parser;

	/** @var DatabaseRepository @inject */
	public $databaseRepository;

	/** @var ElasticSearchRepository @inject */
	public $elasticSearchRepository;

	/**
	 * @var ArrayHash
	 */
	private $config;

	/**
	 * ParserPresenter constructor.
	 * @param array $config Array of parameters from /app/config/common.neon file
	 */
	public function __construct(array $config)
	{
		parent::__construct();
		$this->config = ArrayHash::from($config);
	}

	/**
	 * Default action with main logic.
	 * Parse data from URL.
	 * Save data to DB.
	 * Save data to ElasticSearch index.
	 */
	public function actionDefault(): void
	{
		try {
			// parse data from URL
			$urlContent = $this->parser->downloadUrlContent($this->config->urlSource);
			$data = $this->parser->parse($urlContent);

			// save data to DB
			$this->databaseRepository->saveData($data);

			// elasticSearch
			$this->elasticSearchRepository->indexData($data);

		} catch (GuzzleException $exception) {
			$this->flashMessage('Nepodařilo se stáhnout obsah URL: '.$this->config->urlSource);
		} catch (ParserException $e) {
			$this->flashMessage($e->getMessage());
		}
	}
}

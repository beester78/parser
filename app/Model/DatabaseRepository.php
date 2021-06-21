<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

class DatabaseRepository
{

	/** @var Nette\Database\Context */
	protected $database;
	/**
	 * @var Nette\Caching\IStorage
	 */
	private $storage;

	/**
	 * Repository constructor.
	 * @param Nette\Database\Explorer $database
	 * @param Nette\Caching\IStorage $storage
	 */
	public function __construct(Nette\Database\Explorer $database, Nette\Caching\IStorage $storage)
	{
		$this->database = $database;
		$this->storage = $storage;
	}

	public function saveData($data)
	{
		foreach ($data as $dataItem) {
			$this
				->database
				->table('scraped_data')
				->insert([
					'title' => $dataItem['title'],
					'description' => $dataItem['description'],
					'created' => new Nette\Utils\DateTime(),
				]);
		}
	}

}

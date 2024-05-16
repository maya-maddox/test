<?php
namespace App\Ingestors\CrowdOx;

class CrowdOxDummyDataIngestor
{
    public function __construct(string $file_path)
    {
        $this->filePath = $file_path;
    }

    protected $pageNumber = 1;
    public function pageNumber(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    public function all() {
        if ($this->pageNumber == 1) {
            $strJsonFileContents = file_get_contents(storage_path() . "/dummy-data/". $this->filePath);
            $obj = json_decode($strJsonFileContents);
        }
        else {
            $obj = new EmptyCrowdOxResponse();
        }
        return $obj;
    }
}

class EmptyCrowdOxResponse {
    public $data = [];
}
<?php
class KeywordService
{
    private $searchProvider;
    private $resultRepository;

    public function __construct(SearchProvider $searchProvider, SearchResultRepository $resultRepository)
    {
        $this->searchProvider = $searchProvider;       
        $this->resultRepository = $resultRepository;   
    }

    public function processCsv($file)
    {
        $keywords = $this->parseCsv($file);
        foreach ($keywords as $keyword) {
            $results = $this->searchProvider->search($keyword);
            $this->resultRepository->store($results);
        }
    }

    private function parseCsv($file): array
    {
        $data = array_map('str_getcsv', file($file['tmp_name']));
        return array_column($data, 0); /
    }
}

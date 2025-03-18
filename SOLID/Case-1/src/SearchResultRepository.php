<?php
class SearchResultRepository
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function store(array $data)
    {
        $stmt = $this->db->getPdo()->prepare('INSERT INTO search_results (keyword, results) VALUES (?, ?)');
        $stmt->execute([$data['keyword'], $data['results']]);
    }
}

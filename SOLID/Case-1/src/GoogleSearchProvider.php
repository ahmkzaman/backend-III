<?php
class GoogleSearchProvider implements SearchProvider
{
    public function search(string $keyword): array
    {
        $url = "https://www.google.com/search?q=" . urlencode($keyword);
        $response = file_get_contents($url);
        return [
            'keyword' => $keyword,
            'results' => $response
        ];
    }
}

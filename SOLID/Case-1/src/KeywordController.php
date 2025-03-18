
<?php
class KeywordController
{
    private $keywordService;
    private $auth;

    public function __construct(KeywordService $keywordService, Auth $auth)
    {
        $this->keywordService = $keywordService;
        $this->auth = $auth;
    }

    public function upload($files)
    {
        if (!isset($files['file']) || $files['file']['type'] !== 'text/csv') {
            http_response_code(400);
            return json_encode(['error' => 'Invalid file']);
        }

        $this->keywordService->processCsv($files['file']);
        return json_encode(['message' => 'Keywords processed']);
    }
}

<?php

namespace App\Services;

use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SearchService
{
    protected NodeService $nodeService;
    protected ExtractorService $extractor;

    public function __construct(
        NodeService $nodeService,
        ExtractorService $extractor
    ) {
        $this->nodeService = $nodeService;
        $this->extractor   = $extractor;
    }

    /**
     * Search any keyword or URL.
     */
    public function search(string $keyword): array
    {
        $keyword = trim($keyword);

        if ($keyword === '') {
            return [
                'success' => false,
                'message' => 'Search keyword is required.'
            ];
        }

        $type = $this->detectType($keyword);

        try {

            $result = $this->nodeService->run($keyword);

            if (empty($result['success'])) {

                $this->saveHistory($keyword, $type, $result);

                return $result;
            }

            $cleanData = $this->extractor->extract($result);

            $this->saveHistory($keyword, $type, [
                'success' => true,
                'title'   => $cleanData['title'] ?? null,
                'url'     => $cleanData['url'] ?? null,
                'time'    => $result['time'] ?? 0,
            ]);

            return [
                'success' => true,
                'type'    => $type,
                'data'    => $cleanData,
                'time'    => $result['time'] ?? 0,
                'searched_at' => now()->toDateTimeString(),
            ];

        } catch (Throwable $e) {

            $this->saveHistory($keyword, $type, [
                'success' => false,
                'message' => $e->getMessage(),
                'time'    => 0,
            ]);

            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Save Search History
     */
    private function saveHistory(
        string $keyword,
        string $type,
        array $result
    ): void {

        try {

            SearchHistory::create([

                'user_id'    => Auth::id(),

                'keyword'    => $keyword,

                'type'       => $type,

                'title'      => $result['title'] ?? null,

                'url'        => $result['url'] ?? null,

                'success'    => $result['success'] ?? false,

                'error'      => $result['message'] ?? null,

                'duration'   => $result['time'] ?? 0,

                'ip_address' => request()->ip(),

                'user_agent' => request()->userAgent(),

            ]);

        } catch (Throwable $e) {

            // Ignore database errors

        }
    }

    /**
     * Detect Search Type
     */
    private function detectType(string $keyword): string
    {
        if (filter_var($keyword, FILTER_VALIDATE_URL)) {

            if (str_contains($keyword, 'linkedin.com')) {
                return 'linkedin';
            }

            if (str_contains($keyword, 'github.com')) {
                return 'github';
            }

            if (str_contains($keyword, 'facebook.com')) {
                return 'facebook';
            }

            if (str_contains($keyword, 'instagram.com')) {
                return 'instagram';
            }

            if (str_contains($keyword, 'twitter.com') || str_contains($keyword, 'x.com')) {
                return 'twitter';
            }

            return 'website';
        }

        return 'wikipedia';
    }
}
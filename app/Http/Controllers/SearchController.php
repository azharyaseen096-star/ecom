<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected SearchService $searchService;

    public function __construct()
    {
        $this->searchService = new SearchService();
    }

    /**
     * Search Page
     */
    public function index()
    {
        return view('search.index');
    }

    /**
     * Search Request
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string']
        ]);

        $keyword = trim($request->search);

        $result = $this->searchService->search($keyword);

        if (empty($result['success'])) {

            return redirect()
                ->route('search.index')
                ->with(
                    'error',
                    $result['message'] ?? 'No result found.'
                );

        }

        return redirect()
            ->route('search.index')
            ->with([
                'result' => $result,
                'keyword' => $keyword
            ]);
    }
}
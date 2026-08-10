<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class WikiController extends Controller
{
    public function index()
    {
        return view('wiki.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $search = trim($request->search);

        $search = str_ireplace([
            'who is',
            'what is',
            'tell me about',
            'define',
            'explain'
        ], '', $search);

        $search = trim($search);

        return $this->runScraper($search);
    }

    public function show($title)
    {
        return $this->runScraper($title);
    }

    private function runScraper($keyword)
    {
        $process = new Process([
            'C:\\Program Files\\nodejs\\node.exe',
            base_path('puppeteer\\scraper.js'),
            $keyword
        ]);

        $process->setWorkingDirectory(base_path());

        $process->setEnv([
            'PATH'       => getenv('PATH'),
            'SystemRoot' => getenv('SystemRoot'),
            'TEMP'       => sys_get_temp_dir(),
            'TMP'        => sys_get_temp_dir(),
        ]);

        $process->setTimeout(120);

        $process->run();

        if (!$process->isSuccessful()) {

            return redirect()
                ->route('wiki.index')
                ->with('error', $process->getErrorOutput());
        }

        $output = trim($process->getOutput());

        $result = json_decode($output, true);

        if (!$result) {

            return redirect()
                ->route('wiki.index')
                ->with('error', 'Invalid JSON returned from Puppeteer.<br><pre>' . e($output) . '</pre>');
        }

        if (empty($result['success'])) {

            return redirect()
                ->route('wiki.index')
                ->with(
                    'error',
                    $result['message'] ?? 'No article found.'
                );
        }

        return redirect()
    ->route('wiki.index')
    ->with([
        'result' => [
            'title'       => $result['title'] ?? '',
            'extract'     => $result['summary']
                            ?? $result['description']
                            ?? '',

            'description' => $result['description'] ?? '',
            'summary'     => $result['summary'] ?? '',

            'image'       => $result['image']
                            ?? ($result['images'][0] ?? ''),

            'images'      => $result['images'] ?? [],
            'headings'    => $result['headings'] ?? [],
            'paragraphs'  => $result['paragraphs'] ?? [],
            'links'       => $result['links'] ?? [],
            'lists'       => $result['lists'] ?? [],
            'buttons'     => $result['buttons'] ?? [],
            'forms'       => $result['forms'] ?? [],
            'metaTags'    => $result['metaTags'] ?? [],
            'keywords'    => $result['keywords'] ?? '',
            'emails'      => $result['emails'] ?? [],
            'phones'      => $result['phones'] ?? [],
            'social'      => $result['social'] ?? [],
            'url'         => $result['url'] ?? '',
        ],

        'results' => [
            $result['title'] ?? $keyword
        ]
    ]);
    
    }
}
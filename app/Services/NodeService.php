<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class NodeService
{
    protected string $nodePath;

    protected string $scraperPath;

    protected int $timeout = 180;

    public function __construct()
    {
        $this->nodePath = env(
            'NODE_PATH',
            'C:\\Program Files\\nodejs\\node.exe'
        );

        $this->scraperPath = base_path('puppeteer/scraper.js');
    }

    /**
     * Execute Node Scraper
     */
    public function run(string $keyword): array
    {
        if (!file_exists($this->nodePath)) {

            return [

                'success' => false,

                'message' => 'Node.js executable not found.',

            ];

        }

        if (!file_exists($this->scraperPath)) {

            return [

                'success' => false,

                'message' => 'scraper.js not found.',

            ];

        }

        $process = new Process([

            $this->nodePath,

            $this->scraperPath,

            $keyword

        ]);

        $process->setWorkingDirectory(base_path());

        $process->setTimeout($this->timeout);

        $process->setEnv([

            'PATH' => getenv('PATH'),

            'SystemRoot' => getenv('SystemRoot'),

            'TEMP' => sys_get_temp_dir(),

            'TMP' => sys_get_temp_dir(),

        ]);

        $start = microtime(true);
                try {

            $process->run();

        } catch (\Throwable $e) {

            Log::error('Node Process Exception', [

                'keyword' => $keyword,

                'message' => $e->getMessage()

            ]);

            return [

                'success' => false,

                'message' => $e->getMessage(),

                'time' => 0

            ];

        }

        $time = round((microtime(true) - $start) * 1000);

        $stdout = trim($process->getOutput());

        $stderr = trim($process->getErrorOutput());

        if (!$process->isSuccessful()) {

            Log::error('Node Scraper Failed', [

                'keyword' => $keyword,

                'exit_code' => $process->getExitCode(),

                'stderr' => $stderr,

                'stdout' => $stdout

            ]);

            return [

                'success' => false,

                'message' => $stderr ?: 'Unknown Node.js error.',

                'exit_code' => $process->getExitCode(),

                'time' => $time

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | scraper.js may console.log() bhi ho sakta hai.
        | Isliye last JSON object extract karte hain.
        |--------------------------------------------------------------------------
        */

        $json = $stdout;

        if (preg_match('/\{(?:[^{}]|(?R))*\}$/s', $stdout, $matches)) {

            $json = $matches[0];

        }

        $result = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {

            Log::error('Invalid JSON From Node', [

                'keyword' => $keyword,

                'json_error' => json_last_error_msg(),

                'stdout' => $stdout

            ]);

            return [

                'success' => false,

                'message' => 'Invalid JSON returned from Node.',

                'json_error' => json_last_error_msg(),

                'raw' => $stdout,

                'time' => $time

            ];

        }

        $result['time'] = $time;

        $result['memory'] = memory_get_peak_usage(true);

        $result['exit_code'] = $process->getExitCode();

        Log::info('Node Scraper Success', [

            'keyword' => $keyword,

            'title' => $result['title'] ?? null,

            'url' => $result['url'] ?? null,

            'time' => $time

        ]);

        return $result;
    }
}
<?php

namespace App\Services;

class ExtractorService
{
    /**
     * Extract all useful information from scraper.
     */
    public function extract(array $data): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'title'        => $data['title'] ?? null,
            'description'  => $data['description'] ?? null,
            'url'          => $data['url'] ?? null,
            'website'      => $this->extractWebsite($data),

            /*
            |--------------------------------------------------------------------------
            | Person
            |--------------------------------------------------------------------------
            */

            'name'         => $this->extractName($data),
            'company'      => $this->extractCompany($data),
            'designation'  => $this->extractDesignation($data),
            'location'     => $this->extractLocation($data),
            'country'      => $this->extractCountry($data),
            'address'      => $this->extractAddress($data),

            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'emails'       => $this->extractEmails($data),
            'phones'       => $this->extractPhones($data),

            /*
            |--------------------------------------------------------------------------
            | Social
            |--------------------------------------------------------------------------
            */

            'linkedin'     => $this->extractLinkedIn($data),
            'github'       => $this->extractGithub($data),
            'social_links' => $this->extractSocialLinks($data),

            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */

            'skills'       => $this->extractSkills($data),
            'technologies' => $this->extractTechnologies($data),

            /*
            |--------------------------------------------------------------------------
            | Website Data
            |--------------------------------------------------------------------------
            */

            'images'       => $this->extractImages($data),
            'links'        => $this->extractExternalLinks($data),

            'headings'     => $data['headings'] ?? [],
            'paragraphs'   => $data['paragraphs'] ?? [],
            'lists'        => $data['lists'] ?? [],
            'buttons'      => $data['buttons'] ?? [],
            'forms'        => $data['forms'] ?? [],
            'metaTags'     => $data['metaTags'] ?? [],
            'keywords'     => $data['keywords'] ?? null,

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            'stats' => [

                'images' => count($data['images'] ?? []),

                'links' => count($data['links'] ?? []),

                'emails' => count($this->extractEmails($data)),

                'phones' => count($this->extractPhones($data)),

            ]

        ];
    }
        /*
    |--------------------------------------------------------------------------
    | Basic Extractors
    |--------------------------------------------------------------------------
    */

    private function extractName(array $data): ?string
    {
        return $data['name']
            ?? $data['title']
            ?? null;
    }

    private function extractCompany(array $data): ?string
    {
        return $data['company']
            ?? null;
    }

    private function extractDesignation(array $data): ?string
    {
        return $data['designation']
            ?? null;
    }

    private function extractLocation(array $data): ?string
    {
        return $data['location']
            ?? null;
    }

    private function extractCountry(array $data): ?string
    {
        return $data['country']
            ?? null;
    }

    private function extractAddress(array $data): ?string
    {
        return $data['address']
            ?? null;
    }

    private function extractWebsite(array $data): ?string
    {
        return $data['website']
            ?? $data['url']
            ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | Social Links
    |--------------------------------------------------------------------------
    */

    private function extractLinkedIn(array $data): ?string
    {
        foreach ($data['links'] ?? [] as $link) {

            $href = $link['href'] ?? '';

            if (
                str_contains($href, 'linkedin.com')
            ) {
                return $href;
            }
        }

        return null;
    }

    private function extractGithub(array $data): ?string
    {
        foreach ($data['links'] ?? [] as $link) {

            $href = $link['href'] ?? '';

            if (
                str_contains($href, 'github.com')
            ) {
                return $href;
            }
        }

        return null;
    }

    private function extractSocialLinks(array $data): array
    {
        $social = [];

        foreach ($data['links'] ?? [] as $link) {

            $href = trim($link['href'] ?? '');

            if ($href == '') {
                continue;
            }

            if (
                str_contains($href, 'linkedin.com') ||
                str_contains($href, 'facebook.com') ||
                str_contains($href, 'github.com') ||
                str_contains($href, 'instagram.com') ||
                str_contains($href, 'twitter.com') ||
                str_contains($href, 'x.com') ||
                str_contains($href, 'youtube.com') ||
                str_contains($href, 'threads.net') ||
                str_contains($href, 'tiktok.com')
            ) {

                $social[] = $href;

            }

        }

        return $this->cleanArray($social);
    }
        /*
    |--------------------------------------------------------------------------
    | Emails
    |--------------------------------------------------------------------------
    */

    private function extractEmails(array $data): array
    {
        $text = $this->getText($data);

        preg_match_all(
            '/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i',
            $text,
            $matches
        );

        return $this->cleanArray($matches[0] ?? []);
    }

    /*
    |--------------------------------------------------------------------------
    | Phones
    |--------------------------------------------------------------------------
    */

    private function extractPhones(array $data): array
    {
        $text = $this->getText($data);

        preg_match_all(
            '/(\+?\d[\d\s\-\(\)]{7,20}\d)/',
            $text,
            $matches
        );

        return $this->cleanArray($matches[0] ?? []);
    }

    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */

    private function extractSkills(array $data): array
    {
        $text = strtolower($this->getText($data));

        $skills = [

            "php",
            "laravel",
            "vue",
            "vue.js",
            "javascript",
            "typescript",
            "node",
            "nodejs",
            "react",
            "reactjs",
            "angular",
            "python",
            "java",
            "c#",
            "c++",
            "mysql",
            "mongodb",
            "postgresql",
            "sqlite",
            "redis",
            "docker",
            "kubernetes",
            "aws",
            "azure",
            "git",
            "github",
            "html",
            "css",
            "bootstrap",
            "tailwind",
            "figma",
            "photoshop",
            "wordpress",
            "seo"

        ];

        $found = [];

        foreach ($skills as $skill) {

            if (str_contains($text, strtolower($skill))) {

                $found[] = $skill;

            }

        }

        return $this->cleanArray($found);
    }

    /*
    |--------------------------------------------------------------------------
    | Technologies
    |--------------------------------------------------------------------------
    */

    private function extractTechnologies(array $data): array
    {
        $text = strtolower($this->getText($data));

        $technologies = [

            "laravel",
            "vue",
            "react",
            "angular",
            "node",
            "express",
            "nextjs",
            "nuxt",
            "php",
            "python",
            "django",
            "flask",
            "mysql",
            "mongodb",
            "firebase",
            "supabase",
            "docker",
            "aws",
            "azure",
            "git"

        ];

        $found = [];

        foreach ($technologies as $tech) {

            if (str_contains($text, strtolower($tech))) {

                $found[] = $tech;

            }

        }

        return $this->cleanArray($found);
    }

    /*
    |--------------------------------------------------------------------------
    | Images & Links
    |--------------------------------------------------------------------------
    */

    private function extractImages(array $data): array
    {
        return $this->cleanArray($data['images'] ?? []);
    }

    private function extractExternalLinks(array $data): array
    {
        $links = [];

        foreach ($data['links'] ?? [] as $link) {

            if (!empty($link['href'])) {

                $links[] = $link['href'];

            }

        }

        return $this->cleanArray($links);
    }
        /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Remove duplicate, null and empty values.
     */
    private function cleanArray(array $items): array
    {
        $items = array_map(function ($item) {

            if (is_string($item)) {
                $item = trim($item);
            }

            return $item;

        }, $items);

        $items = array_filter($items, function ($item) {

            if (is_array($item)) {
                return !empty($item);
            }

            return $item !== null && $item !== '';

        });

        return array_values(array_unique($items, SORT_REGULAR));
    }

    /**
     * Convert complete data into searchable text.
     */
    private function getText(array $data): string
    {
        return json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }
}
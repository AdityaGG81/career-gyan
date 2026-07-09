<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use App\Models\IndianCollege;
use App\Models\Career;
use App\Models\JobListing;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml files for Google Search Console (chunked with index)';

    private $urlCount = 0;
    private $fileIndex = 1;
    private $maxUrlsPerFile = 40000;
    private $baseUrl;
    private $now;
    private $currentFileContent = '';

    public function handle()
    {
        $this->info('Generating chunked sitemaps...');

        // Force the base URL to the production domain for SEO purposes
        $this->baseUrl = 'https://careergyan.in';
        $this->now = Carbon::now()->toAtomString();

        
        $this->startNewSitemap();

        // Static routes
        $staticRoutes = [
            '/', '/about', '/explore', '/colleges', '/job-corner',
            '/explore/engineering-colleges', '/explore/medical-colleges',
            '/explore/management-colleges', '/explore/government-defence',
            '/explore/modern-tech',
        ];

        foreach ($staticRoutes as $route) {
            $this->addUrl($this->baseUrl . $route, $this->now, 'daily', '1.0');
        }

        // Colleges
        IndianCollege::select('id', 'updated_at')->chunk(1000, function ($colleges) {
            foreach ($colleges as $college) {
                $lastmod = $college->updated_at ? $college->updated_at->toAtomString() : $this->now;
                $this->addUrl($this->baseUrl . '/colleges/' . $college->id, $lastmod, 'weekly', '0.8');
            }
        });

        // Careers
        $careers = Career::select('slug', 'updated_at')->whereNotNull('slug')->get();
        foreach ($careers as $career) {
            $lastmod = $career->updated_at ? $career->updated_at->toAtomString() : $this->now;
            $this->addUrl($this->baseUrl . '/career/' . $career->slug, $lastmod, 'monthly', '0.8');
        }

        // Jobs
        $jobs = JobListing::select('id', 'updated_at')->where('status', 'open')->get();
        foreach ($jobs as $job) {
            $lastmod = $job->updated_at ? $job->updated_at->toAtomString() : $this->now;
            $this->addUrl($this->baseUrl . '/job-corner/' . $job->id, $lastmod, 'weekly', '0.7');
        }

        $this->closeCurrentSitemap();

        // Generate Sitemap Index
        $this->generateSitemapIndex();

        $this->info("Sitemap generated successfully! Total URLs: {$this->urlCount}");
    }

    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        if ($this->urlCount > 0 && $this->urlCount % $this->maxUrlsPerFile === 0) {
            $this->closeCurrentSitemap();
            $this->fileIndex++;
            $this->startNewSitemap();
        }

        // Escape URL for XML
        $loc = htmlspecialchars($loc, ENT_XML1, 'UTF-8');
        
        $this->currentFileContent .= "\n  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <changefreq>{$changefreq}</changefreq>\n    <priority>{$priority}</priority>\n  </url>";
        $this->urlCount++;
    }

    private function startNewSitemap()
    {
        $this->currentFileContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $this->currentFileContent .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    }

    private function closeCurrentSitemap()
    {
        $this->currentFileContent .= "\n</urlset>";
        $path = public_path("sitemap-{$this->fileIndex}.xml");
        file_put_contents($path, $this->currentFileContent);
        $this->info("Generated: sitemap-{$this->fileIndex}.xml");
    }

    private function generateSitemapIndex()
    {
        $indexContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $indexContent .= "\n" . '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        for ($i = 1; $i <= $this->fileIndex; $i++) {
            $loc = htmlspecialchars($this->baseUrl . "/sitemap-{$i}.xml", ENT_XML1, 'UTF-8');
            $indexContent .= "\n  <sitemap>\n    <loc>{$loc}</loc>\n    <lastmod>{$this->now}</lastmod>\n  </sitemap>";
        }
        
        $indexContent .= "\n</sitemapindex>";
        
        $path = public_path('sitemap.xml');
        file_put_contents($path, $indexContent);
        $this->info("Generated Sitemap Index: sitemap.xml pointing to {$this->fileIndex} chunks.");
    }
}

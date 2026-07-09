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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file for Google Search Console';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $baseUrl = url('/');
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $now = Carbon::now()->toAtomString();

        // Static routes
        $staticRoutes = [
            '/',
            '/about',
            '/explore',
            '/colleges',
            '/job-corner',
            '/explore/engineering-colleges',
            '/explore/medical-colleges',
            '/explore/management-colleges',
            '/explore/government-defence',
            '/explore/modern-tech',
        ];

        foreach ($staticRoutes as $route) {
            $sitemapContent .= $this->createUrlNode($baseUrl . $route, $now, 'daily', '1.0');
        }

        // Colleges
        $colleges = IndianCollege::select('id', 'updated_at')->chunk(500, function ($colleges) use (&$sitemapContent, $baseUrl) {
            foreach ($colleges as $college) {
                $lastmod = $college->updated_at ? $college->updated_at->toAtomString() : Carbon::now()->toAtomString();
                $sitemapContent .= $this->createUrlNode($baseUrl . '/colleges/' . $college->id, $lastmod, 'weekly', '0.8');
            }
        });

        // Careers
        $careers = Career::select('slug', 'updated_at')->whereNotNull('slug')->get();
        foreach ($careers as $career) {
            $lastmod = $career->updated_at ? $career->updated_at->toAtomString() : Carbon::now()->toAtomString();
            $sitemapContent .= $this->createUrlNode($baseUrl . '/career/' . $career->slug, $lastmod, 'monthly', '0.8');
        }

        // Jobs
        $jobs = JobListing::select('id', 'updated_at')->where('status', 'open')->get();
        foreach ($jobs as $job) {
            $lastmod = $job->updated_at ? $job->updated_at->toAtomString() : Carbon::now()->toAtomString();
            $sitemapContent .= $this->createUrlNode($baseUrl . '/job-corner/' . $job->id, $lastmod, 'weekly', '0.7');
        }

        $sitemapContent .= "\n</urlset>";

        // Write to public directory
        $path = public_path('sitemap.xml');
        file_put_contents($path, $sitemapContent);

        $this->info("Sitemap generated successfully at: {$path}");
    }

    private function createUrlNode($loc, $lastmod, $changefreq, $priority)
    {
        return "\n  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <changefreq>{$changefreq}</changefreq>\n    <priority>{$priority}</priority>\n  </url>";
    }
}

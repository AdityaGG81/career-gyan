<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MhtCetCutoffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = [
            database_path('data/mht_cet_cutoffs.json'),
            database_path('data/mht_cet_cutoffs_2026.json'),
        ];
        
        $this->command->info('Truncating mht_cet_cutoffs table...');
        DB::table('mht_cet_cutoffs')->truncate();
        
        foreach ($files as $filePath) {
            if (!File::exists($filePath)) {
                $this->command->warn("The file {$filePath} does not exist. Skipping.");
                continue;
            }
            
            $json = File::get($filePath);
            $data = json_decode($json, true);

            if (empty($data)) {
                $this->command->warn("No data found in {$filePath}.");
                continue;
            }

            $chunks = array_chunk($data, 500);
            $totalInserted = 0;
            $now = now();

            foreach ($chunks as $chunk) {
                $rows = array_map(function ($record) use ($now) {
                    return [
                        'college_code'    => $record['college_code'] ?? null,
                        'college_name'    => $record['college_name'] ?? '',
                        'branch_code'     => $record['branch_code'] ?? null,
                        'branch_name'     => $record['branch_name'] ?? '',
                        'category'        => $record['category'] ?? '',
                        'category_full'   => $record['category_full'] ?? null,
                        'percentile'      => $record['percentile'] ?? 0,
                        'year'            => $record['year'] ?? 2025,
                        'round'           => $record['round'] ?? null,
                        'status'          => $record['status'] ?? null,
                        'quota'           => $record['quota'] ?? null,
                        'merit_no'        => $record['merit_no'] ?? null,
                        'percentile_band' => $record['percentile_band'] ?? null,
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ];
                }, $chunk);
                DB::table('mht_cet_cutoffs')->insert($rows);
                $totalInserted += count($rows);
            }
            $this->command->info("Seeded {$totalInserted} records from {$filePath}");
        }
        
        $this->command->info('MHT-CET cutoffs seeded successfully!');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class IndianCollegeSeeder extends Seeder
{
    public function run(): void
    {
        $existingCount = DB::table('indian_colleges')->count();

        if ($existingCount > 0) {
            $this->command->warn("Found {$existingCount} existing records in indian_colleges table.");
            $this->command->info('Clearing existing data before re-import...');
        }

        DB::table('indian_colleges')->delete();
        $this->seedAllIndiaColleges();
        $this->seedMaharashtraColleges();
        $this->seedCollegesJson();

        // Clear the fuzzy search cache so new data is picked up
        Cache::forget('indian_college_names');

        $finalCount = DB::table('indian_colleges')->count();
        $uniqueCount = DB::table('indian_colleges')
            ->select('college_name', 'district', 'state')
            ->distinct()
            ->count(DB::raw('college_name || district || state'));

        $this->command->info("════════════════════════════════════════");
        $this->command->info("✅ Total rows imported: {$finalCount}");
        $this->command->info("✅ Unique colleges: {$uniqueCount}");
        $this->command->info("════════════════════════════════════════");
    }

    /**
     * Seed from the All-India College.csv dataset
     * Expected columns: State, District, University Type, University Name,
     * College Name, College Type, Affiliation, Management, Website,
     * Year of Establishment, Address, City, Pin Code, Total Enrollment, Faculty Count
     */
    private function seedAllIndiaColleges(): void
    {
        $csvPath = database_path('data/College.csv');

        if (!file_exists($csvPath)) {
            $this->command->warn('College.csv not found at ' . $csvPath . '. Skipping All-India college import.');
            return;
        }

        $this->command->info('Importing All-India colleges from College.csv...');

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            $this->command->error('Could not open College.csv');
            return;
        }

        // Read header row
        $headers = fgetcsv($handle);
        if (!$headers) {
            fclose($handle);
            return;
        }

        // Normalize headers (trim whitespace, lowercase)
        $headers = array_map(function ($h) {
            return strtolower(trim(str_replace([' ', '-'], '_', $h)));
        }, $headers);

        $batch = [];
        $count = 0;
        $batchSize = 500;
        $now = now()->toDateTimeString();

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 5) continue; // Skip malformed rows

            // Map CSV columns to DB columns
            $data = array_combine($headers, array_pad($row, count($headers), null));

            $record = [
                'college_name'          => trim($data['college_name'] ?? $data['college name'] ?? ''),
                'state'                 => trim($data['state'] ?? ''),
                'district'              => trim($data['district'] ?? ''),
                'university_type'       => trim($data['university_type'] ?? $data['university type'] ?? ''),
                'university_name'       => trim($data['university_name'] ?? $data['university name'] ?? ''),
                'college_type'          => trim($data['college_type'] ?? $data['college type'] ?? ''),
                'affiliation'           => trim($data['affiliation'] ?? ''),
                'management'            => trim($data['management'] ?? ''),
                'website'               => trim($data['website'] ?? ''),
                'year_of_establishment' => $this->parseInteger($data['year_of_establishment'] ?? $data['year of establishment'] ?? null),
                'address'               => trim($data['address'] ?? ''),
                'city'                  => trim($data['city'] ?? ''),
                'pin_code'              => trim($data['pin_code'] ?? $data['pin code'] ?? ''),
                'total_enrollment'      => $this->parseInteger($data['total_enrollment'] ?? $data['total enrollment'] ?? null),
                'faculty_count'         => $this->parseInteger($data['faculty_count'] ?? $data['faculty count'] ?? null),
                'created_at'            => $now,
                'updated_at'            => $now,
            ];

            // Skip rows with no college name
            if (empty($record['college_name'])) continue;

            $batch[] = $record;
            $count++;

            if (count($batch) >= $batchSize) {
                DB::table('indian_colleges')->insert($batch);
                $batch = [];
                if ($count % 5000 === 0) {
                    $this->command->info("  Imported {$count} colleges...");
                }
            }
        }

        // Insert remaining
        if (!empty($batch)) {
            DB::table('indian_colleges')->insert($batch);
        }

        fclose($handle);
        $this->command->info("✅ Imported {$count} All-India colleges successfully!");
    }

    /**
     * Seed from the Maharashtra college dataset
     * Expected columns: Sr.No, District, Taluka, College Name, University,
     * College Type, Course Name, Course Type, Is Professional,
     * Course (Aided / Unaided), Course Duration (In months), Course Category
     */
    private function seedMaharashtraColleges(): void
    {
        // Try multiple possible filenames
        $possibleNames = [
            'Maharashtra_Colleges.csv',
            'maharashtra_colleges.csv',
            'maharashtra.csv',
            'survey-of-college-in-maharashtra-for-analysis.csv',
        ];

        $csvPath = null;
        foreach ($possibleNames as $name) {
            $path = database_path('data/' . $name);
            if (file_exists($path)) {
                $csvPath = $path;
                break;
            }
        }

        if (!$csvPath) {
            $this->command->warn('Maharashtra college CSV not found. Skipping Maharashtra import.');
            $this->command->warn('Expected one of: ' . implode(', ', $possibleNames) . ' in database/data/');
            return;
        }

        $this->command->info('Importing Maharashtra colleges from ' . basename($csvPath) . '...');

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            $this->command->error('Could not open ' . basename($csvPath));
            return;
        }

        // Read header row
        $headers = fgetcsv($handle);
        if (!$headers) {
            fclose($handle);
            return;
        }

        // Normalize headers
        $headers = array_map(function ($h) {
            return strtolower(trim($h));
        }, $headers);

        $batch = [];
        $count = 0;
        $batchSize = 500;
        $now = now()->toDateTimeString();

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 4) continue;

            $data = @array_combine($headers, array_pad($row, count($headers), null));
            if (!$data) continue;

            $collegeName = trim($data['college name'] ?? $data['college_name'] ?? '');
            if (empty($collegeName)) continue;

            $record = [
                'college_name'           => $collegeName,
                'state'                  => 'Maharashtra',
                'district'               => trim($data['district'] ?? ''),
                'taluka'                 => trim($data['taluka'] ?? ''),
                'university_name'        => trim($data['university'] ?? $data['university_name'] ?? ''),
                'college_type'           => trim($data['college type'] ?? $data['college_type'] ?? ''),
                'course_name'            => trim($data['course name'] ?? $data['course_name'] ?? ''),
                'course_type'            => trim($data['course type'] ?? $data['course_type'] ?? ''),
                'is_professional'        => trim($data['is professional'] ?? $data['is_professional'] ?? ''),
                'course_aided_unaided'   => trim($data['course (aided / unaided)'] ?? $data['course_aided_unaided'] ?? ''),
                'course_duration_months' => $this->parseInteger($data['course duration (in months)'] ?? $data['course_duration_months'] ?? null),
                'course_category'        => trim($data['course category'] ?? $data['course_category'] ?? ''),
                'created_at'             => $now,
                'updated_at'             => $now,
            ];

            $batch[] = $record;
            $count++;

            if (count($batch) >= $batchSize) {
                DB::table('indian_colleges')->insert($batch);
                $batch = [];
                if ($count % 5000 === 0) {
                    $this->command->info("  Imported {$count} Maharashtra entries...");
                }
            }
        }

        if (!empty($batch)) {
            DB::table('indian_colleges')->insert($batch);
        }

        fclose($handle);
        $this->command->info("✅ Imported {$count} Maharashtra college entries successfully!");
    }

    /**
     * Seed from colleges.json dataset containing all-India colleges
     */
    private function seedCollegesJson(): void
    {
        $jsonPath = database_path('data/colleges.json');

        if (!file_exists($jsonPath)) {
            $this->command->warn('colleges.json not found. Skipping colleges.json import.');
            return;
        }

        $this->command->info('Importing All-India colleges from colleges.json...');

        $jsonData = file_get_contents($jsonPath);
        $colleges = json_decode($jsonData, true);

        if (!is_array($colleges)) {
            $this->command->error('colleges.json has invalid JSON structure.');
            return;
        }

        $batch = [];
        $count = 0;
        $batchSize = 500;
        $now = now()->toDateTimeString();

        foreach ($colleges as $c) {
            $collegeName = trim($c['college'] ?? '');
            if (empty($collegeName)) continue;

            $record = [
                'college_name'    => $collegeName,
                'state'           => trim($c['state'] ?? ''),
                'district'        => trim($c['district'] ?? ''),
                'university_name' => trim($c['university'] ?? ''),
                'college_type'    => trim($c['college_type'] ?? ''),
                'created_at'      => $now,
                'updated_at'      => $now,
            ];

            $batch[] = $record;
            $count++;

            if (count($batch) >= $batchSize) {
                DB::table('indian_colleges')->insert($batch);
                $batch = [];
                if ($count % 5000 === 0) {
                    $this->command->info("  Imported {$count} colleges from JSON...");
                }
            }
        }

        if (!empty($batch)) {
            DB::table('indian_colleges')->insert($batch);
        }

        $this->command->info("✅ Imported {$count} colleges from colleges.json successfully!");
    }

    private function parseInteger($value): ?int
    {
        if ($value === null || $value === '' || $value === 'NA' || $value === 'N/A' || strtolower($value) === 'null') {
            return null;
        }
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        return $cleaned !== '' ? (int)$cleaned : null;
    }
}

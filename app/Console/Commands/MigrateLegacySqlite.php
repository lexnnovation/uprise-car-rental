<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateLegacySqlite extends Command
{
    protected $signature = 'uprise:migrate-legacy-sqlite {path : Absolute path to the recovered SQLite file}';

    protected $description = 'One-off: copy surviving rows from a recovered SQLite file into the current default database connection';

    /**
     * Dependency order matters: parents before children (FK references).
     */
    private const TABLES = [
        'users',
        'vehicle_categories',
        'vehicles',
        'features',
        'feature_vehicle',
        'services',
        'faqs',
        'testimonials',
    ];

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! file_exists($path)) {
            $this->error("File not found: {$path}");

            return self::FAILURE;
        }

        Config::set('database.connections.legacy_sqlite', [
            'driver' => 'sqlite',
            'database' => $path,
            'prefix' => '',
            'foreign_key_constraints' => false,
        ]);

        Schema::disableForeignKeyConstraints();

        foreach (self::TABLES as $table) {
            if (! Schema::connection('legacy_sqlite')->hasTable($table)) {
                $this->warn("Skip {$table}: not present in legacy database.");

                continue;
            }

            $rows = DB::connection('legacy_sqlite')->table($table)->get();

            if ($rows->isEmpty()) {
                $this->line("{$table}: 0 rows, skipping.");

                continue;
            }

            DB::table($table)->truncate();

            foreach ($rows->map(fn ($row) => (array) $row)->chunk(200) as $chunk) {
                DB::table($table)->insert($chunk->all());
            }

            $this->info("{$table}: migrated {$rows->count()} rows.");
        }

        Schema::enableForeignKeyConstraints();

        return self::SUCCESS;
    }
}

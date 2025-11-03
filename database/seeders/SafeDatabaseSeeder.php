<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SafeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds with conflict prevention.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting Safe Database Seeding...');
        
        // Disable foreign key checks temporarily
        Schema::disableForeignKeyConstraints();
        
        try {
            // Check if we're in production
            if (app()->environment('production')) {
                $this->command->info('🔍 Production environment detected - using safe seeding');
                $this->safeProductionSeed();
            } else {
                $this->command->info('🧪 Development environment - using full seeding');
                $this->developmentSeed();
            }
            
        } catch (\Exception $e) {
            $this->command->error('❌ Seeding failed: ' . $e->getMessage());
            throw $e;
        } finally {
            // Re-enable foreign key checks
            Schema::enableForeignKeyConstraints();
        }
        
        $this->command->info('✅ Database seeding completed successfully!');
    }
    
    /**
     * Safe seeding for production environment
     */
    private function safeProductionSeed(): void
    {
        // Only seed essential data if tables are empty
        $this->call([
            AdminSeeder::class,
        ]);
        
        // Check if dosen table is empty before seeding
        if (DB::table('dosens')->count() === 0) {
            $this->call([
                ComprehensiveDosenSeeder::class,
            ]);
        } else {
            $this->command->info('⚠ Dosen table not empty - skipping dosen seeding');
        }
    }
    
    /**
     * Full seeding for development environment
     */
    private function developmentSeed(): void
    {
        $this->call([
            AdminSeeder::class,
            ComprehensiveDosenSeeder::class,
        ]);
    }
}
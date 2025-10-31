<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add columns only if they do not already exist
        if (!Schema::hasColumn('dosens', 'photo')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('photo')->nullable()->after('nama_lengkap');
            });
        }

        if (!Schema::hasColumn('dosens', 'role')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('role')->nullable()->after('alamat');
            });
        }

        if (!Schema::hasColumn('dosens', 'affiliation')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('affiliation')->nullable()->after('role');
            });
        }

        if (!Schema::hasColumn('dosens', 'email')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('email')->nullable()->after('affiliation');
            });
        }

        if (!Schema::hasColumn('dosens', 'scopus_id')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('scopus_id')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('dosens', 'google_id')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('google_id')->nullable()->after('scopus_id');
            });
        }

        if (!Schema::hasColumn('dosens', 'wos_researcher_id')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('wos_researcher_id')->nullable()->after('google_id');
            });
        }

        if (!Schema::hasColumn('dosens', 'garuda_id')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('garuda_id')->nullable()->after('wos_researcher_id');
            });
        }

        if (!Schema::hasColumn('dosens', 'level_department')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('level_department')->nullable()->after('garuda_id');
            });
        }

        if (!Schema::hasColumn('dosens', 'department')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('department')->nullable()->after('level_department');
            });
        }

        if (!Schema::hasColumn('dosens', 'academic_grade')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('academic_grade')->nullable()->after('department');
            });
        }

        if (!Schema::hasColumn('dosens', 'country')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('country')->nullable()->after('academic_grade');
            });
        }

        if (!Schema::hasColumn('dosens', 'id_card')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('id_card')->nullable()->after('country');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $cols = ['photo','role','affiliation','email','scopus_id','google_id','wos_researcher_id','garuda_id','level_department','department','academic_grade','country','id_card'];

        foreach ($cols as $col) {
            if (Schema::hasColumn('dosens', $col)) {
                Schema::table('dosens', function (Blueprint $table) use ($col) {
                    $table->dropColumn($col);
                });
            }
        }
    }
};

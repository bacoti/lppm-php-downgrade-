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
        // Add columns only if they do not already exist (safe to run when DB already has some columns)
        if (!Schema::hasColumn('researches', 'nidn_leader')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('nidn_leader')->nullable()->after('file_final_report');
            });
        }

        if (!Schema::hasColumn('researches', 'leader_name')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('leader_name')->nullable()->after('nidn_leader');
            });
        }

        if (!Schema::hasColumn('researches', 'pddikti_code_pt')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('pddikti_code_pt')->nullable()->after('leader_name');
            });
        }

        if (!Schema::hasColumn('researches', 'institution')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('institution')->nullable()->after('pddikti_code_pt');
            });
        }

        if (!Schema::hasColumn('researches', 'skema_abbreviation')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('skema_abbreviation')->nullable()->after('institution');
            });
        }

        if (!Schema::hasColumn('researches', 'skema_name')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('skema_name')->nullable()->after('skema_abbreviation');
            });
        }

        if (!Schema::hasColumn('researches', 'first_proposal_year')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->year('first_proposal_year')->nullable()->after('skema_name');
            });
        }

        if (!Schema::hasColumn('researches', 'proposed_year_of_activities')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->year('proposed_year_of_activities')->nullable()->after('first_proposal_year');
            });
        }

        if (!Schema::hasColumn('researches', 'year_of_activity')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->year('year_of_activity')->nullable()->after('proposed_year_of_activities');
            });
        }

        if (!Schema::hasColumn('researches', 'duration_of_activity')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->integer('duration_of_activity')->nullable()->after('year_of_activity');
            });
        }

        if (!Schema::hasColumn('researches', 'proposal_status')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->enum('proposal_status', [
                    'draft',
                    'submitted',
                    'approved',
                    'rejected',
                    'revision',
                    'funded',
                    'completed'
                ])->default('draft')->after('duration_of_activity');
            });
        }

        if (!Schema::hasColumn('researches', 'funds_approved')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->decimal('funds_approved', 15, 2)->nullable()->after('proposal_status');
            });
        }

        if (!Schema::hasColumn('researches', 'sinta_affiliation_id')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('sinta_affiliation_id')->nullable()->after('funds_approved');
            });
        }

        if (!Schema::hasColumn('researches', 'funds_institution')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('funds_institution')->nullable()->after('sinta_affiliation_id');
            });
        }

        if (!Schema::hasColumn('researches', 'target_tkt_level')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->integer('target_tkt_level')->nullable()->after('funds_institution');
            });
        }

        if (!Schema::hasColumn('researches', 'hibah_program')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('hibah_program')->nullable()->after('target_tkt_level');
            });
        }

        if (!Schema::hasColumn('researches', 'focus_area')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('focus_area')->nullable()->after('hibah_program');
            });
        }

        if (!Schema::hasColumn('researches', 'fund_source_category')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('fund_source_category')->nullable()->after('focus_area');
            });
        }

        if (!Schema::hasColumn('researches', 'fund_source')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('fund_source')->nullable()->after('fund_source_category');
            });
        }

        if (!Schema::hasColumn('researches', 'country_fund_source')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('country_fund_source')->default('Indonesia')->after('fund_source');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop columns only if they exist to avoid errors on sqlite
        $cols = [
            'nidn_leader',
            'leader_name',
            'pddikti_code_pt',
            'institution',
            'skema_abbreviation',
            'skema_name',
            'first_proposal_year',
            'proposed_year_of_activities',
            'year_of_activity',
            'duration_of_activity',
            'proposal_status',
            'funds_approved',
            'sinta_affiliation_id',
            'funds_institution',
            'target_tkt_level',
            'hibah_program',
            'focus_area',
            'fund_source_category',
            'fund_source',
            'country_fund_source'
        ];

        foreach ($cols as $col) {
            if (Schema::hasColumn('researches', $col)) {
                Schema::table('researches', function (Blueprint $table) use ($col) {
                    $table->dropColumn($col);
                });
            }
        }
    }
};

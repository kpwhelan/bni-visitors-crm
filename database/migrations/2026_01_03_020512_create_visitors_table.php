<?php

use App\Models\Chapter;
use App\Models\User;
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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chapter::class, 'chapter_id')->nullable()->nullOnDelete();
            $table->foreignIdFor(User::class, 'invited_by_user_id')->nullable()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('business_name')->nullable();
            $table->string('industry')->nullable();
            $table->enum('status', [
                'NEW',
                'VISITED',
                'SECOND_VISIT',
                'APPLIED',
                'JOINED',
                'NOT_A_FIT',
            ])->default('NEW');
            $table->date('first_visit_date')->nullable();
            $table->boolean('do_not_contact')->default(false);
            $table->timestamps();

            $table->index('chapter_id');
            $table->index('invited_by_user_id');
            $table->index('status');
            $table->index(['chapter_id', 'status']);
            $table->index(['chapter_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};

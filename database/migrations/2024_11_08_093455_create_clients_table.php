<?php

use App\Models\Facturis\Plan;
use App\Models\Tools\Country;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(Plan::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Country::class)->index()->nullable()->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('telephone')->nullable()->unique();
            $table->string('city')->nullable();
            $table->longText('address')->nullable();
            $table->string('business_name')->nullable();
            $table->string('ice')->nullable()->unique();
            $table->string('website')->nullable();
            $table->json('options')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

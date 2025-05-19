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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 64, 2)
                ->notNull();
            $table->longText('description')->nullable();
            $table->enum('category', ['Office Supply', 'Transportation', 'Honorarium', 'Sponsorship', 'Meals', 'Snacks'])->notNull();
            $table->string('event')->notNull();
            $table->longText('reciept')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

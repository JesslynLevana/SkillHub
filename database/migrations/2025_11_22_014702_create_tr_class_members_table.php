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
        Schema::create('tr_class_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ms_class_id')->constrained('ms_classes')->onDelete('cascade');
            $table->foreignId('ms_member_id')->constrained('ms_members')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['ms_class_id', 'ms_member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_class_members');
    }
};

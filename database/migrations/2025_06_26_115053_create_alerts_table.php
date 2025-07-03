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
       Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('alert_type_id')->constrained('alert_types')->onDelete('cascade');
            $table->string('location_name')->nullable(); // e.g., "Beside Hilltop Restaurant"
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
           
            $table->text('description')->nullable();
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};

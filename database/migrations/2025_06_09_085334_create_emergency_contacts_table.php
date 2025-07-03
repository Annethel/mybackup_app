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
       Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->enum('type', ['personal_contacts', 'helpline']); // friend = contacts with relationship, helpline = police etc.
            $table->string('relationship')->nullable();   // for friends: e.g., "uncle", "neighbor"
            $table->string('address')->nullable();        // optional for friends
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};

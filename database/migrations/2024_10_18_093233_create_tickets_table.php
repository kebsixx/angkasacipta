<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('name'); // Nama
            $table->enum('priority', ['High', 'Low'])->default('Low'); // Prioritas
            $table->dateTime('deadline'); // Deadline
            $table->unsignedBigInteger('office_id')->nullable(); // ID Office
            $table->unsignedBigInteger('location_id')->nullable(); // ID Location
            $table->unsignedBigInteger('category_id')->nullable(); // ID Category
            $table->unsignedBigInteger('subcategory_id')->nullable(); // ID Subcategory
            $table->string('subject')->nullable(); // Subject
            $table->text('description')->nullable(); // Deskripsi
            $table->string('progress')->default('Not Started'); // Progress
            $table->enum('status', ['Ticket Submitted', 'Assigned to Technician'])->default('Assigned to Technician'); // Status
            $table->boolean('assign')->default(false); // Assign
            $table->timestamps(); // Timestamp untuk created_at dan updated_at

            // Tambahkan foreign key constraints
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('assign');
        });
    }
}

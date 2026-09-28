<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('work_requests', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->foreignId('client_id')->constrained('clients');
            $table->string('requester_name');
            $table->string('site')->nullable();
            $table->string('url')->nullable();
            $table->text('description');
            $table->date('deadline')->nullable();
            $table->foreignId('staff_member_id')->nullable()->constrained('staff_members')->nullOnDelete();
            $table->string('status')->default('unhandled');

            $table->timestamps();
        });

        Schema::create('work_request_attachments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('work_request_id')
                ->constrained('work_requests')
                ->cascadeOnDelete();

            $table->string('original_name');
            $table->string('file_path');

            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_request_id')->constrained('work_requests')->cascadeOnDelete();
            $table->string('poster_name');
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('message_id')
                ->constrained('messages')
                ->cascadeOnDelete();

            $table->string('original_name');
            $table->string('file_path');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_attachments');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('work_request_attachments');
        Schema::dropIfExists('work_requests');
        Schema::dropIfExists('staff_members');
        Schema::dropIfExists('clients');
    }
};

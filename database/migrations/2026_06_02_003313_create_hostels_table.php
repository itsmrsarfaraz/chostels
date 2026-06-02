<?php

use App\Enums\Hostel\HostelStatusEnum;
use App\Enums\Hostel\HostelTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('hostel_type')->default(HostelTypeEnum::MALE->value);
            $table->text('description')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_title')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('address')->nullable();
            $table->boolean('has_mess_menu')->default(false);
            $table->string('status')->default(HostelStatusEnum::DRAFT->value);
            $table->timestamps();
            $table->index('owner_id');
            $table->index('status');
            $table->index('hostel_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostels');
    }
};
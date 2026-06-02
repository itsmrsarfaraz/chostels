<?php

use App\Enums\Room\RoomTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('room_type')->default(RoomTypeEnum::SHARED->value);
            $table->integer('total_beds');
            $table->decimal('monthly_rent',10,2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('hostel_id');
            $table->index('room_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
<?php

use App\Enums\Booking\BookingSourceEnum;
use App\Enums\Booking\BookingStatusEnum;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bed_id')->constrained()->cascadeOnDelete();
            $table->foreignId('seeker_id')->constrained('users')->cascadeOnDelete();
            $table->date('check_in_date');
            $table->date('check_out_date')->nullable();
            $table->decimal('monthly_rent', 10, 2);
            $table->string('status')->default(BookingStatusEnum::PENDING->value);
            $table->string('source')->default(BookingSourceEnum::SELF->value);
            $table->timestamps();
            $table->index('hostel_id');
            $table->index('room_id');
            $table->index('bed_id');
            $table->index('seeker_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

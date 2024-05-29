<?php

use App\Enum\RoomStatus;
use App\Enum\RoomType;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->enum('type',[RoomType::SINGLE->value,RoomType::DOUBLE->value,RoomType::SUITE->value]);
            $table->enum('status',[RoomStatus::AVAILABLE->value,RoomStatus::BOOKED->value,RoomStatus::PENDING->value])->default(RoomStatus::AVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

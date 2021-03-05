<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateTableAddTicketTable extends Migration
{
    public function up(): void
    {
        Schema::create(
            'tickets',
            function (Blueprint $table): void {
                $table->id();
                $table->boolean('available')->default(true);
                $table->foreignId('event_id');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}

<?php

use App\Models\Helpdesk\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Helpdesk\TicketMeta as Model;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Model::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Model::FIELD_TICKET_ID)
                ->index()
                ->constrained(Ticket::TABLE_NAME)
                ->onDelete('cascade');
            $table->string(Model::FIELD_KEY,50);
            $table->text(Model::FIELD_CONTENT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Model::TABLE_NAME);
    }
};

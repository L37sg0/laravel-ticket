<?php

use App\Models\Helpdesk\Department;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Helpdesk\Ticket as Model;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Model::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Model::FIELD_DEPARTMENT_ID)
                ->index()
                ->constrained(Department::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreignId(Model::FIELD_PARENT_ID)
                ->nullable()
                ->index()
                ->constrained(Model::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreignId(Model::FIELD_CUSTOMER_ID)
                ->nullable()
                ->index()
                ->constrained(User::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreignId(Model::FIELD_AGENT_ID)
                ->nullable()
                ->index()
                ->constrained(User::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->tinyInteger(Model::FIELD_INITIATOR)->default(1);
            $table->string(Model::FIELD_EXT_ID,40);
            $table->string(Model::FIELD_SUBJECT, 100);
            $table->text(Model::FIELD_CONTENT);
            $table->tinyInteger(Model::FIELD_STATUS)->default(1);
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

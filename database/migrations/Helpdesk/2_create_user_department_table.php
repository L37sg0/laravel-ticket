<?php

use App\Models\Helpdesk\Department;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Helpdesk\UserDepartment as Model;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Model::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Model::FIELD_USER_ID)
                ->index()
                ->constrained(User::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreignId(Model::FIELD_DEPARTMENT_ID)
                ->index()
                ->constrained(Department::TABLE_NAME)
                ->onDelete('no action')
                ->onUpdate('no action');
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

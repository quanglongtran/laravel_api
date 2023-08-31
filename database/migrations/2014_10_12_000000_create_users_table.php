<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER prevent_update_super_admin
            BEFORE UPDATE ON users FOR EACH ROW
            BEGIN
                IF OLD.id = 1 THEN
                    SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = \'Super admin cannot be updated\';
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_delete_super_admin
            BEFORE DELETE ON users FOR EACH ROW
            BEGIN
                IF OLD.id = 1 THEN
                    SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = \'Super admin cannot be deleted\';
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        DB::unprepared('DROP TRIGGER IF EXISTS `prevent_delete_super_admin`');
        DB::unprepared('DROP TRIGGER IF EXISTS `prevent_update_super_admin`');
    }
};

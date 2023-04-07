<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAuditTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total_requests');
            $table->unsignedBigInteger('total_failed_validations');
            $table->unsignedBigInteger('total_positive_requests');
            $table->unsignedBigInteger('total_negative_requests');
            $table->timestamps();
        });

        // requests only increase therefore should not modified to less than current requests
        DB::unprepared(
            "CREATE TRIGGER validate_requests 
                BEFORE UPDATE ON audit_trail FOR EACH ROW 
                BEGIN 
                IF (
                    (NEW.total_requests < OLD.total_requests) 
                    || (NEW.total_failed_validations < OLD.total_failed_validations) 
                    || (NEW.total_positive_requests < OLD.total_positive_requests) 
                    || (NEW.total_negative_requests < OLD.total_negative_requests) 
                ) 
                
                THEN 
                    SIGNAL SQLSTATE '45000' 
                    SET MESSAGE_TEXT = 'Can only increment requests'; 
                END IF; 
                END;
            "
        );

        DB::unprepared(
            "CREATE TRIGGER prevent_audit_deleting
                BEFORE DELETE ON audit_trail
                FOR EACH ROW
                BEGIN
                    SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Deleting audits not allowed';
                END;
        "
        );

        // create default 0 values since no requests made yet on system
        DB::statement(
            "INSERT INTO audit_trail (total_requests, total_failed_validations, total_positive_requests, total_negative_requests, created_at) 
            VALUES (0, 0, 0, 0, NOW());"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_trail');
    }
}

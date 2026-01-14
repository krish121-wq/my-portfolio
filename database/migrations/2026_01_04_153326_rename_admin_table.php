<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        if(Schema::hasTable('admin')) {
            Schema::rename('admin', 'admins');
        }
    }

    public function down(): void
    {
        // Rollback karne par wapas purana naam ho jayega
        if(Schema::hasTable('admins')) {
            Schema::rename('admins', 'admin');
        }
    }
};
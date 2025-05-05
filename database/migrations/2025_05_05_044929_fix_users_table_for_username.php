<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::table('users', function (Blueprint $table) {
               // Tambahkan kolom username jika belum ada
               if (!Schema::hasColumn('users', 'username')) {
                   $table->string('username')->unique()->after('name');
               }

               // Hapus kolom email jika ada
               if (Schema::hasColumn('users', 'email')) {
                   $table->dropColumn('email');
               }

               // Hapus kolom email_verified_at jika ada
               if (Schema::hasColumn('users', 'email_verified_at')) {
                   $table->dropColumn('email_verified_at');
               }
           });
       }

       public function down(): void
       {
           Schema::table('users', function (Blueprint $table) {
               // Kembalikan kolom email dan email_verified_at
               if (!Schema::hasColumn('users', 'email')) {
                   $table->string('email')->unique()->nullable()->after('name');
               }
               if (!Schema::hasColumn('users', 'email_verified_at')) {
                   $table->timestamp('email_verified_at')->nullable()->after('email');
               }
               // Hapus kolom username jika ada
               if (Schema::hasColumn('users', 'username')) {
                   $table->dropColumn('username');
               }
           });
       }
   };
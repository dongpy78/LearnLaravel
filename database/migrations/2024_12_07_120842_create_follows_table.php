<?php

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
        Schema::create('follows', function (Blueprint $table) {
            $table->id(); //! Khóa chính
            $table->foreignId('user_id')->constrained(); //! Id của người dùng thực hiện hành động follow

            $table->unsignedBigInteger('followeduser'); //! Id của người dùng đang bị follow
            $table->foreign('followeduser')->references('id')->on('users'); //! Thời gian tạo bảng ghi

            $table->timestamps(); //! Thời gian bản ghi được cập nhật lần cuối
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};

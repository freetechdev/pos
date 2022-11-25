<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Evergreen Ply Center');
            $table->string('address')->default('Ring Road, Behind Traffice Station, Sukhedhara, Kathmandu-5, Nepal');
            $table->string('phone')->default('+977-014653731');
            $table->string('fax')->default('+977-9851067101');
            $table->string('email')->default('evergreenplycenter@gmail.com');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};

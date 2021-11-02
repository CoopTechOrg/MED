<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('paid_at')->comment('支払日');
            $table->unsignedBigInteger('payee_id')->comment('支払先ID');
            $table->unsignedBigInteger('family_id')->comment('支払者(家族)ID');
            $table->boolean('is_deducted')->comment('控除されるかどうか true: 3割負担, false: 10割負担');
            $table->boolean('is_own_expensed')->comment('自費か、保険からの出費か')->default(true);
            $table->unsignedBigInteger('insurance_company_id')->comment('保険会社ID')->nullable()->default(null);
            $table->unsignedInteger('price')->comment('出費額(負担額)');
            $table->string('remarks')->comment('備考');
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
        Schema::dropIfExists('payments');
    }
}

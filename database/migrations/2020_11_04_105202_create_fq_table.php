<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFqTable extends Migration
{
    public $tableName = 'fq';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->longText('content')->comment('详情');
            $table->integer('order_no')
                ->default(0)
                ->comment('排序');
            $table->timestamps();
        });
        DB::select("ALTER TABLE {$this->tableName} COMMENT = '常见问题'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}

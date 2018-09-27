<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_usuario', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('permission_id')->unsigned()->index()->references('id')->on('permissions')->onDelete('cascade');
			$table->integer('usuario_id')->unsigned()->index()->references('id')->on('usuarios')->onDelete('cascade');
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
		Schema::drop('permission_usuario');
	}

}

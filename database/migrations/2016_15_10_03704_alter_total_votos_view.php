<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTotalVotosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::raw("Alter View totalvotos as
			Select
				vp.proposicao_id,
 vp.parlamentar_id, vu.user_id,
				if(((vp.voto <> 2) && (vp.voto = vu.voto)), 1, 0) as igual,
				if(((vp.voto <> 2) && (vp.voto <> vu.voto)), 1, 0) as diferente,
				if(((vp.voto = 2) && (vu.voto <> 2)), 1, 0) as indiferente
			From
				votos_parlamentares vp
					Inner Join votos_users vu ON vp.proposicao_id = vu.proposicao_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw("drop view totalvotos");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ProfilStatutEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("profils", function (Blueprint $table) {

            $table->engine = "InnoDB";
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("image")->nullable();
            $table->enum("statut", array_column(ProfilStatutEnum::cases(), 'value'));
            $table->unsignedBigInteger("administrateur_id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("administrateur_id")
                ->references("id")->on("administrateurs")
                ->onUpdate("restrict")
                ->onDelete("restrict");

        });
    }

    public function down(): void
    {
        Schema::table(dropForeign("artistes_administrateur_id_foreign"));
        $table->dropSoftDeletes();
        Schema::dropIfExists("profils");
    }
};

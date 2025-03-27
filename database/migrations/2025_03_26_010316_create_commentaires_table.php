<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("commentaires", function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->text("contenu");
            $table->unsignedBigInteger("administrateur_id");
            $table->unsignedBigInteger("profil_id");
            $table->timestamps();

            $table->primary(["administrateur_id", "profil_id"]);

            $table->foreign("administrateur_id")
                ->references("id")->on("administrateurs")
                ->onUpdate("restrict")
                ->onDelete("restrict");

            $table->foreign("profil_id")
                ->references("id")->on("profils")
                ->onUpdate("restrict")
                ->onDelete("restrict");

        });
    }

    public function down(): void
    {
        Schema::table(dropForeign("artistes_administrateur_id_foreign"));
        Schema::table(dropForeign("artistes_profil_id_foreign"));
        Schema::dropIfExists("commentaires");
    }
};

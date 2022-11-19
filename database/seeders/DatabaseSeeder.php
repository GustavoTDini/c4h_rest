<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Doacao;
use App\Models\DoacaoMensal;
use App\Models\Endereco;
use App\Models\RedesSociais;
use App\Models\Telefone;
use App\Models\TipoRede;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Usuario::factory(50)->create();
        TipoRede::factory(10)->create();
        Doacao::factory(100)->create();
        DoacaoMensal::factory(20)->create();
        Endereco::factory(60)->create();
        Telefone::factory(60)->create();
        RedesSociais::factory(60)->create();

    }
}

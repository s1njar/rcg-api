<?php

namespace Modules\Cards\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CardTypesSeederTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'Light Melee Infantry',
            'light_melee_infantry'
        ],
        [
            'Heavy Melee Infantry',
            'heavy_Melee_infantry'
        ],
        [
            'Light Distance Infantry',
            'light_distance_infantry'
        ],
        [
            'Heavy Distance Infantry',
            'heavy_distance_infantry'
        ],
        [
            'Cavalry',
            'cavalry'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach (self::DEFAULT_RARITY_VALUES as $value) {
            $this->insert($value[0], $value[1]);
        }
    }

    /**
     * @param string $name
     * @param string $code
     */
    private function insert(string $name, string $code)
    {
        DB::table('card_types')->insertOrIgnore([
            'name' => $name,
            'code' => $code
        ]);
    }
}

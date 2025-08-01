<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\CompanyUnit;

class CompaniesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('company_units')->truncate();
        DB::table('companies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $plnUitJbm = Company::create([
            'name' => 'PLN UIT JBM',
            'description' => 'PLN Unit Induk Transmisi Jawa Bagian Timur, Bali & Madura',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $plnUnits = [
            'KANTOR INDUK',
            'UPT SURABAYA',
            'UPT MALANG',
            'UPT GRESIK',
            'UPT MADIUN',
            'UPT PROBOLINGGO',
            'UPT BALI',
        ];

        foreach ($plnUnits as $unitName) {
            CompanyUnit::create([
                'company_id' => $plnUitJbm->id,
                'name' => $unitName,
                'description' => "Unit Pelayanan Transmisi {$unitName}",
                'is_active' => true,
            ]);
        }
    }

}

<?php

namespace Database\Seeders;

use App\Models\PaymentLinkName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentLinksNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentLinkName::factory(10)->create();
    }
}

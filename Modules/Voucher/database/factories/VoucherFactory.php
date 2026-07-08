<?php
namespace Modules\Voucher\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Voucher\Models\Voucher;

class VoucherFactory extends Factory
{
    protected $model = Voucher::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->word,
            'code'           => $this->faker->unique()->bothify('VOUCHER-####'),
            'start_at'       => now()->subDay()->toDateString(),
            'end_at'         => now()->addMonth()->toDateString(),
            'type'           => 'fixed',
            'amount'         => 10000,
            'total_quantity' => 10,
            'used_count'     => 0,
            'is_active'      => true,
        ];
    }
}

<?php
namespace Modules\Voucher\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\Voucher;

interface VoucherRepositoryInterface
{
    public function list(array $filters = []): Collection;

    public function create(VoucherPayload $payload): Voucher;

    public function find(int $id): ?Voucher;

    public function update(Voucher $voucher, VoucherPayload $payload): Voucher;
}

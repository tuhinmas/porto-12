<?php
namespace Modules\Voucher\Services;

use Illuminate\Support\Collection;
use Modules\Voucher\Repositories\VoucherRepository;

class GetVouchers
{
    public function __construct(protected VoucherRepository $voucherRepository)
    {}

    public function handle(array $filters = []): Collection
    {
        return $this->voucherRepository->list($filters);
    }
}

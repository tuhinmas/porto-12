<?php
namespace Modules\Voucher\Services;

use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Repositories\VoucherRepository;

class GetVoucher
{
    public function __construct(protected VoucherRepository $voucherRepository)
    {}

    public function handle(int $id): ?Voucher
    {
        return $this->voucherRepository->find($id);
    }
}

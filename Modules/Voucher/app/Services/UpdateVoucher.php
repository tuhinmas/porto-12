<?php
namespace Modules\Voucher\Services;

use Illuminate\Support\Facades\DB;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Repositories\VoucherRepository;

class UpdateVoucher
{
    public function __construct(protected VoucherRepository $voucherRepository)
    {}

    public function handle(int $id, array $data): ?Voucher
    {
        return DB::transaction(function () use ($id, $data) {
            $voucher = $this->voucherRepository->find($id);

            if (! $voucher) {
                return null;
            }

            $isActive          = now()->format('Y-m-d') >= $data['start_at'] && now()->format('Y-m-d') <= $data['end_at'];
            $data['is_active'] = $isActive;

            $payload = VoucherPayload::fromArray(array_merge($voucher->toArray(), $data));

            return $this->voucherRepository->update($voucher, $payload);
        });
    }
}

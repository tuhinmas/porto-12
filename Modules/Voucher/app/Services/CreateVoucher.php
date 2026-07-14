<?php
namespace Modules\Voucher\Services;

use Illuminate\Support\Facades\DB;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Models\VoucherOrganization;
use Modules\Voucher\Repositories\VoucherOrganizationRepository;
use Modules\Voucher\Repositories\VoucherRepository;

class CreateVoucher
{
    public function __construct(
        protected VoucherOrganizationRepository $voucherOrganizationRepository,
        protected VoucherRepository $voucherRepository,
    ) {}

    public function handle(array $data): Voucher
    {
        return DB::transaction(function () use ($data) {
            $isActive          = now()->format('Y-m-d') >= $data['start_at'] && now()->format('Y-m-d') <= $data['end_at'];
            $data['is_active'] = $isActive;

            $voucherOrg             = $this->createVoucherOrganization($data, $isActive);
            $data['voucher_org_id'] = $voucherOrg->id;

            $payload = VoucherPayload::fromArray($data);

            return $this->voucherRepository->create($payload);
        });
    }

    protected function createVoucherOrganization(array $data, bool $isActive): VoucherOrganization
    {
        $payload = VoucherPayload::fromArray(array_merge($data, ['is_active' => $isActive]));

        return $this->voucherOrganizationRepository->create($payload);
    }
}

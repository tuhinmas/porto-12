<?php
namespace Modules\Voucher\Services;

use Illuminate\Support\Collection;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Repositories\VoucherOrganizationRepository;
use Modules\Voucher\Repositories\VoucherRepository;

class VoucherService
{
    public function __construct(
        protected VoucherRepository $voucherRepository,
        protected VoucherOrganizationRepository $voucherOrganizationRepository,
    ) {}

    public function list(array $filters = []): Collection
    {
        return $this->voucherRepository->list($filters);
    }

    public function create(array $data): Voucher
    {
        $payload    = VoucherPayload::fromArray($data);
        $voucherOrg = $this->voucherOrganizationRepository->create($payload);

        $data['voucher_org_id'] = $voucherOrg->id;
        $payload                = VoucherPayload::fromArray($data);

        return $this->voucherRepository->create($payload);
    }

    public function find(int $id): ?Voucher
    {
        return $this->voucherRepository->find($id);
    }

    public function update(int $id, array $data): ?Voucher
    {
        $voucher = $this->voucherRepository->find($id);

        if (! $voucher) {
            return null;
        }

        $payload = VoucherPayload::fromArray(array_merge($voucher->toArray(), $data));

        return $this->voucherRepository->update($voucher, $payload);
    }
}

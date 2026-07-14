<?php
namespace Modules\Voucher\Repositories;

use Modules\Voucher\Contracts\VoucherOrganizationRepositoryInterface;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\VoucherOrganization;

class VoucherOrganizationRepository implements VoucherOrganizationRepositoryInterface
{
    public function create(VoucherPayload $payload): VoucherOrganization
    {
        return VoucherOrganization::create([
            'organization_id'     => $payload->organizationId,
            'store_id'            => $payload->storeId,
            'name'                => $payload->name,
            'code'                => $payload->code,
            'start_at'            => $payload->startAt,
            'end_at'              => $payload->endAt,
            'type'                => $payload->type,
            'amount'              => $payload->amount,
            'total_quantity'      => $payload->totalQuantity,
            'is_active'           => $payload->isActive,
            'min_transaction'     => $payload->minTransaction,
            'max_discount_amount' => $payload->maxDiscountAmount,
            'is_stackable'        => $payload->isStackable,
        ]);
    }
}

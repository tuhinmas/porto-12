<?php
namespace Modules\Voucher\DTO;

class VoucherPayload
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly string $startAt,
        public readonly string $endAt,
        public readonly string $type,
        public readonly float $amount,
        public readonly?int $organizationId = null,
        public readonly?int $storeId = null,
        public readonly?int $voucherOrgId = null,
        public readonly int $totalQuantity = 0,
        public readonly bool $isActive = true,
        public readonly float $minTransaction = 0,
        public readonly?float $maxDiscountAmount = null,
        public readonly bool $isStackable = true,
    ) {}

    public function toArray(): array
    {
        return [
            'organization_id'     => $this->organizationId,
            'store_id'            => $this->storeId,
            'voucher_org_id'      => $this->voucherOrgId,
            'name'                => $this->name,
            'code'                => $this->code,
            'start_at'            => $this->startAt,
            'end_at'              => $this->endAt,
            'type'                => $this->type,
            'amount'              => $this->amount,
            'total_quantity'      => $this->totalQuantity,
            'is_active'           => $this->isActive,
            'min_transaction'     => $this->minTransaction,
            'max_discount_amount' => $this->maxDiscountAmount,
            'is_stackable'        => $this->isStackable,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'],
            startAt: $data['start_at'],
            endAt: $data['end_at'],
            type: $data['type'],
            amount: (float) ($data['amount'] ?? 0),
            organizationId: $data['organization_id'] ?? null,
            storeId: $data['store_id'] ?? null,
            voucherOrgId: $data['voucher_org_id'] ?? null,
            totalQuantity: (int) ($data['total_quantity'] ?? 0),
            isActive: (bool) ($data['is_active'] ?? true),
            minTransaction: (float) ($data['min_transaction'] ?? 0),
            maxDiscountAmount: isset($data['max_discount_amount']) ? (float) $data['max_discount_amount'] : null,
            isStackable: (bool) ($data['is_stackable'] ?? true),
        );
    }
}

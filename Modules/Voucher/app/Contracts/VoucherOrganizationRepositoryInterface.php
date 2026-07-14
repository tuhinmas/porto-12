<?php
namespace Modules\Voucher\Contracts;

use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\VoucherOrganization;

interface VoucherOrganizationRepositoryInterface
{
    public function create(VoucherPayload $payload): VoucherOrganization;
}

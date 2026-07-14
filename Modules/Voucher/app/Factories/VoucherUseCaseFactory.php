<?php
namespace Modules\Voucher\Factories;

use Modules\Voucher\Contracts\VoucherOrganizationRepositoryInterface;
use Modules\Voucher\Contracts\VoucherRepositoryInterface;
use Modules\Voucher\Enums\CrudType;
use Modules\Voucher\Services\CreateVoucher;
use Modules\Voucher\Services\GetVoucher;
use Modules\Voucher\Services\GetVouchers;
use Modules\Voucher\Services\UpdateVoucher;

class VoucherUseCaseFactory
{
    public function __construct(
        protected VoucherRepositoryInterface $voucherRepository,
        protected VoucherOrganizationRepositoryInterface $voucherOrganizationRepository,
    ) {}

    public function create(CrudType $type): object
    {
        return match ($type) {
            CrudType::LIST   => new GetVouchers($this->voucherRepository),
            CrudType::CREATE => new CreateVoucher($this->voucherOrganizationRepository, $this->voucherRepository),
            CrudType::GET    => new GetVoucher($this->voucherRepository),
            CrudType::UPDATE => new UpdateVoucher($this->voucherRepository),
            CrudType::DELETE => new class($this->voucherRepository)
            {
                public function __construct(protected VoucherRepositoryInterface $repository)
                {}

                public function handle(int $id): bool
                {
                    $voucher = $this->repository->find($id);

                    if (! $voucher) {
                        return false;
                    }

                    return (bool) $voucher->delete();
                }
            },
        };
    }
}

<?php
namespace Modules\Voucher\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Voucher\DTO\VoucherPayload;
use Modules\Voucher\Models\Voucher;

class VoucherRepository
{
    public function list(array $filters = []): Collection
    {
        $query = Voucher::query();

        if (! empty($filters['organization_id'])) {
            $query->where('organization_id', $filters['organization_id']);
        }

        if (! empty($filters['store_id'])) {
            $query->where('store_id', $filters['store_id']);
        }

        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('code', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->orderByDesc('id')->get();
    }

    public function create(VoucherPayload $payload): Voucher
    {
        return Voucher::create($payload->toArray());
    }

    public function find(int $id): ?Voucher
    {
        return Voucher::find($id);
    }

    public function update(Voucher $voucher, VoucherPayload $payload): Voucher
    {
        $voucher->fill($payload->toArray());
        $voucher->save();

        return $voucher;
    }
}

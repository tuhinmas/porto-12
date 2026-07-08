<?php
namespace Modules\Voucher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Voucher\Services\VoucherService;

class VoucherController extends Controller
{
    public function __construct(protected VoucherService $voucherService)
    {}

    public function index(Request $request): JsonResponse
    {
        $vouchers = $this->voucherService->list([
            'organization_id' => $request->query('organization_id'),
            'store_id'        => $request->query('store_id'),
            'search'          => $request->query('search'),
        ]);

        return response()->json($vouchers);
    }

    public function store(Request $request): JsonResponse
    {
        $voucher = $this->voucherService->create($request->all());

        return response()->json($voucher, 201);
    }

    public function show(string $id): JsonResponse
    {
        $voucher = $this->voucherService->find((int) $id);

        if (! $voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json($voucher);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $voucher = $this->voucherService->update((int) $id, $request->all());

        if (! $voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json($voucher);
    }

    public function destroy(string $id): JsonResponse
    {
        $voucher = $this->voucherService->find((int) $id);

        if (! $voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $voucher->delete();

        return response()->json(null, 204);
    }
}

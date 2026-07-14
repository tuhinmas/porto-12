<?php
namespace Modules\Voucher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Voucher\Enums\CrudType;
use Modules\Voucher\Factories\VoucherUseCaseFactory;

class VoucherController extends Controller
{
    public function __construct(protected VoucherUseCaseFactory $factory)
    {}

    public function index(Request $request): JsonResponse
    {
        $service = $this->factory->create(CrudType::LIST);

        $vouchers = $service->handle([
            'organization_id' => $request->query('organization_id'),
            'store_id'        => $request->query('store_id'),
            'search'          => $request->query('search'),
        ]);

        return response()->json($vouchers);
    }

    public function store(Request $request): JsonResponse
    {
        $service = $this->factory->create(CrudType::CREATE);
        $voucher = $service->handle($request->all());

        return response()->json($voucher, 201);
    }

    public function show(string $id): JsonResponse
    {
        $service = $this->factory->create(CrudType::GET);
        $voucher = $service->handle((int) $id);

        if (! $voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json($voucher);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $service = $this->factory->create(CrudType::UPDATE);
        $voucher = $service->handle((int) $id, $request->all());

        if (! $voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json($voucher);
    }

    public function destroy(string $id): JsonResponse
    {
        $service = $this->factory->create(CrudType::DELETE);
        $deleted = $service->handle((int) $id);

        if (! $deleted) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        return response()->json(null, 204);
    }
}

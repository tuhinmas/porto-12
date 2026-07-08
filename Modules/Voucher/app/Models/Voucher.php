<?php
namespace Modules\Voucher\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $guarded = [];

    protected $casts = [
        'amount'              => 'float',
        'total_quantity'      => 'integer',
        'used_count'          => 'integer',
        'min_transaction'     => 'float',
        'max_discount_amount' => 'float',
        'is_active'           => 'boolean',
        'is_stackable'        => 'boolean',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(VoucherOrganization::class, 'voucher_org_id');
    }
}

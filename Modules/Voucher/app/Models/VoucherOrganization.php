<?php
namespace Modules\Voucher\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoucherOrganization extends Model
{
    use HasFactory;

    protected $table = 'voucher_organizations';

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

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'voucher_org_id');
    }
}

<?php

namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutoVouchingAssetsManagement extends Model
{
    use HasFactory;

    public $timestamps    = false;
    protected $table      = 'asset_accounts_integration';
    protected $primaryKey = 'id';
    protected $fillable = [
    'module_name',
    'action_type',
    'debit_account_id',
    'credit_account_id',
    'description'
];

    
    
}

<?php
namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;


class Asset_Types extends Model
{
    #use SoftDeletes;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //const CREATED_AT = null;
    //const UPDATED_AT = null;
    //const DELETED_AT = null;
    
    public $timestamps    = false;
    protected $table      = 'asset_types';
    protected $primaryKey = 'id';
    protected $fillable   = ['name',];

}


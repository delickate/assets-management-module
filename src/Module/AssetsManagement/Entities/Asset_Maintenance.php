<?php
namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;


class Asset_Maintenance extends Model
{
    #use SoftDeletes;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //const CREATED_AT = null;
    //const UPDATED_AT = null;
    //const DELETED_AT = null;
    
    public $timestamps    = false;
    protected $table      = 'asset_maintenance';
    protected $primaryKey = 'id';
    protected $fillable   = ['maintenance_date','type','cost','remarks','asset_id',];

    public function Assets()

    {

       return $this->belongsTo(Assets::class,'asset_id','id');

    }

}


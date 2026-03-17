<?php
namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;


class Assets extends Model
{
    #use SoftDeletes;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //const CREATED_AT = null;
    //const UPDATED_AT = null;
    //const DELETED_AT = null;
    
    public $timestamps    = false;
    protected $table      = 'assets';
    protected $primaryKey = 'id';
    protected $fillable   = ['asset_tag','asset_name','brand','model','serial_number','purchase_date','purchase_cost','warranty_expiry_date','warranty_expiry_date','remarks','vendor_id','location_id','asset_type_id',];

    public function Vendors()

    {

       return $this->belongsTo(Vendors::class,'vendor_id','id');

    }

    public function Locations()

    {

       return $this->belongsTo(Locations::class,'location_id','id');

    }

    public function Asset_Types()

    {

       return $this->belongsTo(Asset_Types::class,'asset_type_id','id');

    }

}


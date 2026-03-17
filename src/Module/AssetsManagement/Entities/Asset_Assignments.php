<?php
namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\AssetsManagement\Entities\Asset_Types;
use Modules\AssetsManagement\Entities\Assets;

class Asset_Assignments extends Model
{
    #use SoftDeletes;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //const CREATED_AT = null;
    //const UPDATED_AT = null;
    //const DELETED_AT = null;
    
    public $timestamps    = false;
    protected $table      = 'asset_assignments';
    protected $primaryKey = 'id';
    protected $fillable   = ['assigned_date','expected_return_date','returned_date','remarks','asset_id','asset_type_id',];

    public function Assets()

    {

       return $this->belongsTo(Assets::class,'asset_id','id');

    }

    public function Asset_Types()

    {

       return $this->belongsTo(Asset_Types::class,'asset_type_id','id');

    }

}


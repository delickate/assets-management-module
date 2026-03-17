<?php
namespace Modules\AssetsManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;


class Asset_Returns extends Model
{
    #use SoftDeletes;
use SoftDeletes;

    protected $dates = ['deleted_at'];
    //const CREATED_AT = null;
    //const UPDATED_AT = null;
    //const DELETED_AT = null;
    
    public $timestamps    = false;
    protected $table      = 'asset_returns';
    protected $primaryKey = 'id';
    protected $fillable   = ['return_date','condition','remarks','asset_assignment_id',];

    public function Asset_Assignments()

    {

       return $this->belongsTo(Asset_Assignments::class,'asset_assignment_id','id');

    }

}


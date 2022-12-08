<?php

namespace Tots\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Tots\Auth\Models\TotsUser;

/**
 * Description of Model
 *
 * @author matiascamiletti
 */
class TotsAccountPermission extends Model
{
    protected $table = 'tots_account_permission';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function account()
    {
        return $this->belongsTo(TotsAccount::class, 'account_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(TotsUser::class, 'user_id');
    }
}
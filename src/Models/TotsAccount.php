<?php

namespace Tots\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Tots\Auth\Models\TotsUser;

/**
 * Description of Model
 *
 * @author matiascamiletti
 */
class TotsAccount extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const STATUS_NON_PAYMENT = 3;

    protected $table = 'tots_account';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;

    public function creator()
    {
        return $this->hasOneThrough(TotsUser::class, TotsAccountPermission::class, 'account_id', 'id', 'id', 'user_id');
    }
}
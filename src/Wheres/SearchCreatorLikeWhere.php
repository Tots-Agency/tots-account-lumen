<?php

namespace Tots\Account\Wheres;

use Exception;
use \Illuminate\Database\Eloquent\Model;
use Tots\EloFilter\Where\AbstractWhere;

/**
 * Description of Configure
 *
 * @author matiascamiletti
 */
class SearchCreatorLikeWhere extends AbstractWhere 
{
    protected $type = 'search-creator';
    /**
     * List of keys
     *
     * @var array
     */
    protected $keys = [];

    public function __construct($data)
    {
        $this->value = $data['value'];
    }
    /**
     * 
     *
     * @param Model $query
     * @return void
     */
    public function run($query)
    {
        $query->whereRaw('(
            (tots_account.title REGEXP ?)
            OR (tots_account.address REGEXP ?)
            OR ( (SELECT COUNT(tots_user.id) FROM tots_account_permission INNER JOIN tots_user ON tots_user.id = tots_account_permission.user_id WHERE tots_account_permission.account_id = tots_account.id AND (CONCAT(tots_user.firstname, " ", tots_user.lastname) REGEXP ? OR tots_user.email REGEXP ?) ) > 0 )
        )', [$this->value, $this->value, $this->value, $this->value]);
    }
    /**
     * Undocumented function
     *
     * @param array $keys
     * @return void
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getKeys()
    {
        return $this->keys;
    }
    /**
     * Verify if key is same
     *
     * @param string $key
     * @return boolean
     */
    public function isSameKey($key)
    {
        foreach($this->keys as $keyInt){
            if($keyInt == $key){
                return true;
            }
        }

        return false;
    }
}
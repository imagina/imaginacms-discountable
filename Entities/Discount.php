<?php

namespace Modules\Discountable\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ihelpers\Traits\Relationable;
use Modules\Ruleable\Traits\RuleableTrait;

class Discount extends Model
{

    use Relationable, RuleableTrait;

    protected $table = 'discountable__discounts';
    protected $fillable = [
        'name',
        'status',
        'value',
        'type',
        'criteria',
        'code',
    ];

    public function discountable(){
        return $this->morphTo('discountable', 'discountable__discountable', 'discount_id', 'discountable_id');
    }


}

<?php

namespace Modules\Discountable\Repositories\Cache;

use Modules\Discountable\Repositories\DiscountRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheDiscountDecorator extends BaseCacheDecorator implements DiscountRepository
{
    public function __construct(DiscountRepository $discount)
    {
        parent::__construct();
        $this->entityName = 'discountable.discounts';
        $this->repository = $discount;
    }
}

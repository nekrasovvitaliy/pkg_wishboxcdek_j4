<?php

/**
 * Copyright (c) Antistress.Store® 2021. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Sergey Gusev
 */

namespace WishboxCdekSDK2\Entity\Responses;

use WishboxCdekSDK2\Traits\ServicesTrait;

class ServiceResponse extends Source
{
    use ServicesTrait;
    /**
     * Стоимость дополнительной услуги.
     *
     * @var float
     */
    protected $sum;

    /**
     * Get стоимость дополнительной услуги.
     *
     * @return float
     */ 
    public function getSum()
    {
        return $this->sum;
    }
}

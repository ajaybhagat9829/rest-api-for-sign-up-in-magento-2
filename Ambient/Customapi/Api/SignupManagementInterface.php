<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ambient\Customapi\Api;

interface SignupManagementInterface
{

    /**
     * POST for Signup api
     * @return string
     */
    public function postSignup();
}


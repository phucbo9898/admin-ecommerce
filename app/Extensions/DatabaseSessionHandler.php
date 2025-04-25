<?php

declare(strict_types=1);

namespace App\Extensions;

use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Session\DatabaseSessionHandler as BaseDatabaseSessionHandler;

class DatabaseSessionHandler extends BaseDatabaseSessionHandler
{
    /**
     * @throws BindingResolutionException
     */
    protected function addUserInformation(&$payload): DatabaseSessionHandler|static
    {
        if ($this->container->bound(Factory::class)) {
            $payload['web_user_id'] = $this->webUserId();
            $payload['admin_user_id'] = $this->adminUserId();
        }

        return $this;
    }

    /**
     * @throws BindingResolutionException
     */
    protected function webUserId()
    {
        $user = $this->getUser('user');

        return $user ? $user->id : null;
    }

    /**
     * @throws BindingResolutionException
     */
    protected function adminUserId()
    {
        $user = $this->getUser('admin');

        return $user ? $user->id : null;
    }

    /**
     * @throws BindingResolutionException
     */
    protected function getUser($guard)
    {
        return $this->container->make(Factory::class)->guard($guard)->user();
    }
}

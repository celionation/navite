<?php

declare(strict_types=1);

namespace NaviteCore\Traits;

use NaviteCore\Base\Exception\BaseLogicException;
use NaviteCore\Global\GlobalManager;
use NaviteCore\Session\SessionManager;

trait SystemTrait
{
    public static function sessionInit(bool $useSessionGlobal = false)
    {
        $session = SessionManager::initialize();
        if(!$session)
        {
            throw new BaseLogicException("Please Enable session within your (session.yaml) configuration file.");
        } else if($useSessionGlobal === true) {
            GlobalManager::set('global_session', $session);
        } else {
            return $session;
        }
    }
}
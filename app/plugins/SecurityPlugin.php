<?php
declare(strict_types=1);

namespace App\Plugins;

use Phalcon\Acl\Enum;
use Phalcon\Acl\Role;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

class SecurityPlugin extends Injectable
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guest';
        } else if ($auth['is_admin'] === '1') {
            $role = 'Admin';
        } else {
            $role = 'User';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isComponent($controller)) {
            $dispatcher->forward([
                'controller' => 'error',
                'action' => 'show404',
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'controller' => 'error',
                'action' => 'show401',
            ]);

            return false;
        }

        return true;
    }

    protected function getAcl(): AclList
    {
        if (isset($this->session->acl)) {
            return $this->session->acl;
        }

        $acl = new AclList();
        $acl->setDefaultAction(Enum::DENY);

        $roles = [
            'guest' => new Role(
                'Guest',
                'Deny access to all private resources.',
            ),
            'user' => new Role(
                'User',
                'Member privileges, granted after sign in.',
            ),
            'admin' => new Role(
                'Admin',
                'Grant privileges for all private resources after sign in.',
            ),
        ];

        $roles = $this->di->getShared('config')->roles->toArray();
        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        $components = $this->di->get('config')->components->toArray();

        foreach ($components as $component => $actions) {
            $acl->addComponent($component, $actions);
        }

        $accesslist = $this->di->get('config')->accesslist->toArray();

        $guestAccess = $accesslist['Guest'];

        foreach ($guestAccess as $component => $actions) {
            foreach ($actions as $action) {
                $acl->allow('*', $component, $action);
            }
        }

        $userAccess = $accesslist['User'];

        foreach ($userAccess as $component => $actions) {
            foreach ($actions as $action) {
                $acl->allow('User', $component, $action);
            }
        }

        $adminAccess = $accesslist['Admin'];

        foreach ($adminAccess as $component => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Admin', $component, $action);
            }
        }

        $this->session->acl = $acl;

        return $acl;
    }
}
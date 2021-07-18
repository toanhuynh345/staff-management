<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Customize middleware permission.
     *
     * @param array $middleware
     * @param array $options
     */
    public function middlewarePermission($middleware = [], $options = [])
    {
        if (!is_array($middleware)) {
            $middleware = [$middleware];
        }
        $permissions = array_merge(['permission:admin.full'], $middleware);
        $this->middleware(implode('|', $permissions), $options);
    }

    /**
     * Auto redirect to last page.
     *
     * @param object  $object
     * @param booleam $isExistPage
     * @param mixed   $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToLastPage($object, $params)
    {
        $controller = explode('App\\Http\\Controllers\\', app('request')->route()->getActionName());

        if ($object->isEmpty() && $object->total()) {
            $params['page'] = $object->lastPage();

            return action($controller[1], $params);
        }

        return null;
    }
}

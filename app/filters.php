<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    // Clear view cache in sandbox (only) with every request
    if (App::environment() == 'local') {

        $cachedViewsDirectory = app('path.storage') . '/views/';
        $files = glob($cachedViewsDirectory . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
        //Manage Permission
        $permissions = Config::get('permissions');
        foreach ($permissions as $key => $val) {
            $permission = DB::table('permissions')->where('value', $val)->first();
            if (!$permission) {
                DB::table('permissions')->insert(
                    array('name' => $key, 'value' => $val, 'description' => $key)
                );
            }
        }
        //Save Default Groups
        $groups = Config::get('groups.default');
        $permissions = [];
        foreach ($groups as $group) {
            // create group
            $exit = DB::table('groups')->where('name', $group)->first();
            if (!$exit)
                Sentry::getGroupProvider()->create(array(
                    'name' => $group,
                    'permissions' => $permissions,
                ));
        }
    }
});

App::after(function ($request, $response) {
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        }
        return Redirect::guest('login');
    }
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
    if (Session::token() !== Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
Route::filter('hasPermissions', function ($route, $request, $userPermission = null) {
    if (Route::currentRouteNamed('putUser') && Sentry::getUser()->id == Request::segment(3) ||
        Route::currentRouteNamed('showUser') && Sentry::getUser()->id == Request::segment(3)
    ) {
    } else {
        if ($userPermission === null) {
            $permissions = array_merge(Config::get('permissions'), Config::get('syntara::permissions'));
            $permission = $permissions[Route::current()->getName()];
        } else {
            $permission = $userPermission;
        }

        if (!Sentry::getUser()->hasAccess($permission)) {
            return Redirect::route('accessDenied');
        }
    }
});
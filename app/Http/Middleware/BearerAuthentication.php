<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\UserService;
use Closure;

/**
 * Bearer認証周り
 *
 * Class BearerAuthentication
 * @package App\Http\Middleware
 */
class BearerAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization');
        if ($authorization === null) return response('{}', 400);

        // Authorizationヘッダの形式チェック
        if (strpos($authorization, ' ') === false) return response('{}', 400);

        $authorization = explode(' ', $authorization);

        // Bearerが指定されていない場合
        if ($authorization[0] !== 'Bearer:') return response('{}', 400);

        // アクセストークンに対応するユーザが存在するか
        $user = User::where('access_token', $authorization[1])->first();
        if ($user === null) return response('{}', 401);

        return $next($request);
    }
}

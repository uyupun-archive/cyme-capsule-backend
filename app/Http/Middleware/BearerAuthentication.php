<?php

namespace App\Http\Middleware;

use App\Models\User;
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
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        // Authorizationヘッダがあるかどうか
        if ($authorization === null) return response(json_encode(['WWW-Authenticate' => 'Bearer realm="token_required"']), 401);

        // Authorizationヘッダの形式が正しいかどうか()
        if (strpos($authorization, ' ') === false) return response(json_encode(['WWW-Authenticate' => 'Bearer error="invalid_request"']), 400);
        $authorization = explode(' ', $authorization);
        if ($authorization[0] !== 'Bearer:') return response(json_encode(['WWW-Authenticate' => 'Bearer error="invalid_request"']), 400);

        // アクセストークンに対応するユーザが存在するか
        $user = User::where('access_token', $authorization[1])->first();
        if ($user === null) return response(json_encode(['WWW-Authenticate' => 'Bearer error="invalid_token"']), 401);

        return $next($request);
    }
}

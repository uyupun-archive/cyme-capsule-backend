<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * 認証系API
 *
 * Class AuthController
 * @package App\Http\Controllers\Api\V1
 */
class AuthController extends Controller
{
    /**
     * 登録
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function register()
    {
        $request = request();

        // バリデーション
        $validator = Validator::make($request->all(), [
            'user_id'   => ['bail', 'required', 'regex:/^[a-zA-Z0-9_]+$/', ],
            'password'  => ['bail', 'required', 'string', ],
        ]);
        if ($validator->fails()) return response('{}', 400);

        // すでに存在するユーザかどうかの判定
        if (User::where('user_id', $request->user_id)->first() != null) return response('{}', 409);

        // ユーザの作成
        $user = new User;
        $user->user_id = $request->user_id;
        $user->password = bcrypt($request->password);

        // トークンの生成
        $access_token = substr(bin2hex(random_bytes(32)), 0, 32);

        // トークンの格納
        $user->access_token = $access_token;
        $user->save();

        return response(['access_token' => $access_token], 200);
    }

    /**
     * ログイン
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function login()
    {
        $request = request();

        // バリデーション
        $validator = Validator::make($request->all(), [
            'user_id'   => ['bail', 'required', 'regex:/^[a-zA-Z0-9_]+$/', ],
            'password'  => ['bail', 'required', 'string', ],
        ]);
        if ($validator->fails()) return response('{}', 400);

        // 正当なユーザかどうかの判定
        $user = User::where('user_id', $request->user_id)->first();
        if ($user == null) return response('{}', 409);
        if (!Hash::check($request->password, $user->password)) return response('{}', 409);

        // トークンの生成
        $access_token = substr(bin2hex(random_bytes(32)), 0, 32);

        // トークンの更新
        User::where('user_id', $request->user_id)->update([
            'access_token' => $access_token,
        ]);

        return response(['access_token' => $access_token], 200);
    }

    /**
     * ログアウト
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        $request = request();

        // トークンをnullにする
        User::where('access_token', $request->access_token)->update([
            'access_token' => null,
        ]);

        return response('{}', 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * カプセル操作系API
 *
 * Class CapsuleController
 * @package App\Http\Controllers\Api\V1
 */
class CapsuleController extends Controller
{
    /**
     * 埋めたカプセル一覧の取得
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function buriedList()
    {
        return response([], 200);
    }

    /**
     * 掘り起こしたカプセル一覧の取得
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dugList()
    {
        return response([], 200);
    }

    /**
     * カプセルを開く
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function open()
    {
        return response([], 200);
    }

    /**
     * カプセルを埋める
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bury()
    {
        return response([], 200);
    }

    /**
     * カプセルを探す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function search()
    {
        return response([], 200);
    }

    /**
     * カプセルを掘り出す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dig()
    {
        return response([], 200);
    }
}

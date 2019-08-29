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
        $request = request();

        $data = [
            [
                "id" => 1,
                "capsule_name" => "あいう",
            ],[
                "id" => 2,
                "capsule_name" => "えおかき"
            ]
        ];
        return response(json_encode($data), 200);
    }

    /**
     * 掘り起こしたカプセル一覧の取得
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dugList()
    {
        $request = request();

        $data = [
            [
                "id" => 1,
                "capsule_name" => "umerareta",
            ],[
                "id" => 2,
                "capsule_name" => "capsuletachi"
            ]
        ];
        return response(json_encode($data), 200);
    }

    /**
     * カプセルを開く
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function open()
    {
        $request = request();

        $data = [
            "id" => 1,
            "capsule_name" => "aaaaa",
            "longitude" => 1.14514,
            "latitude" => 1.919810,
            "burier" => "XXXX",
            "message" => "XXXXXXXXXX",
            "dug_at" => "XXXX"
        ];
        return response(json_encode($data), 200);
    }

    /**
     * カプセルを埋める
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bury()
    {
        $request = request();

        return response([], 200);
    }

    /**
     * カプセルを探す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function search()
    {
        $request = request();

        $data = [
            [
                "id" => 1,
                "capsule_name" => "aaaa",
            ],[
                "id" => 2,
                "capsule_name" => "bbbb"
            ]
        ];
        return response(json_encode($data), 200);
    }

    /**
     * カプセルを掘り出す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dig()
    {
        $request = request();

        $data = [
            "id"=> 1,
            "capsule_name"=> "XXXX",
            "longitude"=> 1.14514,
            "latitude"=> 1.919810,
            "burier"=> "XXXX",
            "message"=> "XXXXXXXXXX",
            "dug_at"=> "XXXX"
        ];
        return response(json_encode($data), 200);
    }
}

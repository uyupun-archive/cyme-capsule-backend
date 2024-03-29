<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TimeCapsule;
use App\Models\User;
use Carbon\Carbon;

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
        $userId = User::where('access_token', $this->getAccessToken())->first()->user_id;
        $data = TimeCapsule::select('id', 'capsule_name')->where('buried_user_id', $userId)->get();
        return response(json_encode($data), 200);
    }

    /**
     * 掘り出したカプセル一覧の取得
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dugList()
    {
        $userId = User::where('access_token', $this->getAccessToken())->first()->user_id;
        $data = TimeCapsule::select('id', 'capsule_name')->where('dug_user_id', $userId)->get();
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

        if(!isset($request->id) || null == $request->id){
            return response('Bad Request', 400);
        }
        $data = TimeCapsule::select('id', 'capsule_name', 'longitude', 'latitude', 'user_name as burier', 'message', 'dug_at')
            ->find(intval($request->id));

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
        $user = $this->getUser($request);
        $capsule = new TimeCapsule;

        $capsule->capsule_name = $request->capsule_name;
        $capsule->longitude = $request->longitude;
        $capsule->latitude = $request->latitude;
        $capsule->buried_user_id = $user->id;
        $capsule->message = $request->message;
        $capsule->user_name = $request->burier;

        $capsule->save();
        // 時間があったらsaveできなかったときの処理を入れたい
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

        $data = TimeCapsule::select(['id', 'capsule_name', 'longitude', 'latitude'])
            ->whereNull('dug_user_id')
            ->get()
            ->toArray();
        foreach($data as $idx => $row){
            $long_diff = $request->input('longitude') - $row['longitude'];
            $lati_diff = $request->input('latitude') - $row['latitude'];
            $data[$idx]['total_diff'] = sqrt($long_diff**2+$lati_diff**2);
        }
        usort($data , array($this, 'geoSort'));
        $data = array_map(function($row){
            unset($row['total_diff'],$row['longitude'], $row['latitude']);
            //ここで消さなければ距離を返せる
            // ただし緯度経度的な距離なのでメートルとかにするには再計算が必要
            return $row;
        }, $data);
        // array_slice 第三引数で件数指定
        return response(json_encode(array_slice($data, 0, 10)), 200);
    }

    /**
     * カプセルを掘り出す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dig()
    {
        $request = request();
        $data = TimeCapsule::where('id',$request->id)->first();
        //すでに掘り起こされているカプセルでないかの確認
        if($data->dug_user_id != null){
            return response('すでに誰かに掘り起こされています',200);
        } else {
            $user = $this->getUser($request);
            $data->dug_user_id = $user->id;
            $data->dug_at = Carbon::now();
            $data->save();
            $data = TimeCapsule::select('id','capsule_name','longitude','latitude','user_name as burier','message','dug_at')
                ->where('id', $request->id)
                ->first();
            return response(json_encode($data, 200));
        }
    }

    /**
     * 緯度経度によるソート
     *
     * @param $a
     * @param $b
     * @return int
     */
    private function geoSort($a, $b)
    {
        // $cmp = strcmp($a->name, $b->name);
        if($a['total_diff'] == $b['total_diff']){
            return 0;
        }
        // キャストされると精度的に辛いのでとりあえず100倍してみている
        // リアルなカプセルの位置情報を入れてみておかしかったら直す
        return ( $a['total_diff'] *100 < $b['total_diff'] * 100) ? -1 : 1;
    }

    /**
     * @return mixed
     */
    private function getUser($request)
    {
        $authorization = $request->header('Authorization');
        $authorization = explode(' ', $authorization);
        return User::where('access_token', $authorization[1])->first();
    }
}
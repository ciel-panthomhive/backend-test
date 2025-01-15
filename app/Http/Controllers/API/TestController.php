<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Models\tb_matrix;
use Illuminate\Http\Request;

class TestController extends Controller
{

    
    //Create (POST)
    function create(TestRequest $request)
    {
        $panjang = $request['panjang'];
        $tinggi = $request['tinggi'];
        $cek = tb_matrix::where('panjang', $panjang)->get();
        $jml = 0;
        foreach($cek as $ch ){
            if($ch['tinggi'] == $tinggi){
                $jml++;
            }
        }

        if($jml == 0){
            $creates = tb_matrix::create($request->all());
            return response()->json([
                'message' => 'Data berhasil disimpan.', 
                'data' => $creates
            ], 201);
        } else {
            return response()->json([
                'message' => 'Data sudah ada.', 
            ], 200);
        }
    }

    //Update (PUT)
    function update($id, TestRequest $request)
    {
        $matrix = tb_matrix::findOrFail($id);
        $matrix->update($request->all());
        return response()->json([
            'message' => 'Data berhasil disimpan.', 
            'data' => $matrix
        ], 200);
    }


    //Delete (DELETE)
    function destroy($id)
    {
        $matrix = tb_matrix::findOrFail($id);
        $matrix->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }


    //Read – Single by Id (GET)
    function get($id)
    {
        if (isset($id)) {
            $matrix = tb_matrix::findOrFail($id);
            $ran = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
            // echo json_encode($ran);
           

            $randomize = array();
            for($i = 1; $i <= $matrix['tinggi']; $i++) {                
                for ($j = 1; $j <= $matrix['panjang']; $j++) {
                    // $random = array($ran[array_rand($ran)]);
                    $random = array_rand($ran);
                    $rnd['x'] = $i;
                    $rnd['y'] = $j;
                    $rnd['value'] = $random;

                    array_push($randomize, $rnd);
                }              
            }
            // var_dump($randomize);
            // var_dump($matrix);

            $data = array(
                'id' => $matrix['id'],
                'panjang' => $matrix['panjang'],
                'tinggi' => $matrix['tinggi'],
                'randomized_matrix' => $randomize
            );

            return response()->json([
                'message' => 'Data berhasil ditemukan.',
                'data' => $data,
                // 'randomized_matrix' => $randomize
            ], 200);
        } else {
            $matrix = tb_matrix::get();
            return response()->json([
                'message' => 'Data tidak ditemukan', 
                'data' => $matrix
            ], 200);
        }
    }

    //Read – List (GET)
    function get_list($skip, $take)
    {
        $matrix = tb_matrix::skip($skip)->take($take)->get();
        $count = count($matrix);
        return response()->json([
            'message' => 'Data berhasil ditemukan.',
            'data' => $matrix,
            'count' => $count,
            'skip' => $skip,
            'take' => $take
        ], 200);

    }

}

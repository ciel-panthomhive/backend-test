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
        try {
            $panjang = $request['panjang'];
            $tinggi = $request['tinggi'];
            
            $creates = tb_matrix::create($request->all());
            
            return response()->json([
                'message' => 'Data berhasil disimpan.',
                'data' => $creates
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }

    //Update (PUT)
    function update($id, TestRequest $request)
    {
        try {
            $matrix = tb_matrix::findOrFail($id);
            $matrix->update($request->all());

            return response()->json([
            'message' => 'Data berhasil disimpan.', 
            'data' => $matrix
        ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }

    //Delete (DELETE)
    function destroy($id)
    {
        try {
            $matrix = tb_matrix::findOrFail($id);
            $matrix->delete();
            return response()->json(['message' => 'Data deleted'], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ], 500);
        }
    }


    //Read – Single by Id (GET)
    function get($id)
    {
        // if (isset($id)) {
        try {
            $matrix = tb_matrix::findOrFail($id);
            $ran = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);

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

            $data = array(
                'id' => $matrix['id'],
                'panjang' => $matrix['panjang'],
                'tinggi' => $matrix['tinggi'],
                'randomized_matrix' => $randomize
            );

            return response()->json([
                'message' => 'Data berhasil ditemukan.',
                'data' => $data,
            ], 200);

        } catch (\Throwable $th) {
            $matrix = tb_matrix::get();
            return response()->json([
                'message' => 'Data tidak ditemukan', 
            ], 500);
        }
    }

    //Read – List (GET)
    function get_list($skip, $take)
    {
        try {
            $matrix = tb_matrix::skip($skip)->take($take)->get();
            $count = count($matrix);
            return response()->json([
                'message' => 'Data berhasil ditemukan.',
                'data' => $matrix,
                'count' => $count,
                'skip' => $skip,
                'take' => $take
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tidak ada data yang dapat ditampilkan.'
            ], 500);
        }
    }

}

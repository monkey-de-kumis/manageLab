<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chemicals;
use App\Analysis;
use App\Analysis_detail;
use App\Activity;
use Cookie;
use DB;

class AnalysisController extends Controller
{
    //
    public function addAnalys()
    {
      $chemicals = Chemicals::orderBy('created_at', 'DESC')->get();
      return view('analyses.add',compact('chemicals'));
    }

    public function getChemicals($id)
    {
      $chemicals = Chemicals::findOrFail($id);
      return response()->json($chemicals, 200);
    }

    public function addToElenmeyer(Request $request)
    {
      //validate data request
      //from ajax Request addToElenmeyer
      $this->validate($request, [
        'chemicals_id' => 'required|exists:chemicals,id',
        'qty' =>'required|integer'
      ]);
      print_r($request->chemicalas_id);
      //get data chemicals by id
      $chemicals = Chemicals::findOrFail($request->chemicalas_id);
      // get coookies elenmeyer with $request->cookie('elenmeyer')
      $getElenmeyer = json_decode($request->cookie('elenmeyer'), true);
      print_r($getElenmeyer);
      //if exist data
      if($getElenmeyer) {
        // if key exist base on chemicals_id
        if(array_key_exists($request->chemicals_id, $getElenmeyer)) {
          //count qty
          $getElenmeyer[$request->chemicals_id]['qty'] += $request->qty;
          //send back to save on cookies
          return response()->json($getElenmeyer, 200)
            ->cookie('elenmeyer', json_encode($getElenmeyer), 180);
        }
      }

      //if empty elenmeyer, add new Data
      $getElenmeyer[$request->chemicals_id] = [
        'name' => $chemicals->name,
        'formula' => $chemicals->formula,
        'qty' => $request->qty
      ];
        //send back to save on cookies
      return response()->json($getElenmeyer, 200)
        ->cookie('elenmeyer', json_encode($getElenmeyer), 180);

    }

    public function getElenmeyer()
    {
      //get elenmeyer from cookies
      $elenmeyer = json_decode(request()->cookie('elenmeyer'), true);
      //return on json for show with vuejs
      return response()->json($elenmeyer, 200);
    }

    public function removeElenmeyer($id)
    {
      $elenmeyer = json_decode(request()->cookie('elenmeyer'), true);
      //del base on chemicals_id
      unset($elenmeyer[$id]);
      //elenmeyer re new
      return response()->json($elenmeyer, 200)
        ->cookie('elenmeyer', json_encode($elenmeyer));
    }

    public function checkout()
    {
      return view('analyses.checkout');
    }

    public function storeAnalysis(Request $request)
    {
      /*
      //validasi
      $this->validate($request, [
        ''
      ]);

      //get list elenmeyer from cookie
      $elenmeyer = json_decode($request->cookie('elenmeyer'), true);


      DB::beginTransaction();
      try {

      }
      */
    }
}

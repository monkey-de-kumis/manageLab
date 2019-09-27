<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Analysis_detail;
use App\Chemicals;
use App\Stock;
use DB;

class HomeController extends Controller
{
    //
    public function index()
    {
      $data = array();
      $stock = array();
      $i = 0;
      $chemicals = DB::table('chemicals')
        ->join('units', 'chemicals.unit_id', '=', 'units.id')
        ->join('tocsins', 'chemicals.tocsin_id', '=', 'tocsins.id')
        ->select('chemicals.*','units.name as satuan','tocsins.name as tocsins')
        ->get();

        $stocks = DB::table('stocks')->get();

        foreach ($chemicals as $key => $alchemy) {
          $data["Chemical"][$key]["id"] = $alchemy->id;
          $data["Chemical"][$key]["name"] = $alchemy->name;
          $data["Chemical"][$key]["formula"] = $alchemy->formula;
          $data["Chemical"][$key]["satuan"] = $alchemy->satuan;
          $data["Chemical"][$key]["tocsins"] = $alchemy->tocsins;
          $data["Chemical"][$key]["stock"] = 0;
          $data["Chemical"][$key]["sisa"] = 0;
          $data["Chemical"][$key]["pakai"] = 0;
          if($alchemy->tocsins=="Beracun") {
            $data["Chemical"][$key]["class"] = "bg-danger";
          } else {
            $data["Chemical"][$key]["class"]= "bg-success";
          }
          foreach($stocks as $stock) {
            if ($stock->chemicals_id == $alchemy->id) {
              $data["Chemical"][$key]["stock"] += $stock->qty;
            }
          }
          $data["Chemical"][$key]["stock_tot"] = $data["Chemical"][$key]["stock"]*$alchemy->volume;
        }

      $usings  = DB::table('analysis_details')->get();

      foreach($data["Chemical"] as $key => $val) {
        foreach($usings as $use) {
          if($val["id"]==$use->chemical_id) {
            $data["Chemical"][$key]["pakai"] += $use->qty;
          }
        }
          $data["Chemical"][$key]["sisa"] = $val["stock_tot"] - $data["Chemical"][$key]["pakai"];
          if($data["Chemical"][$key]["sisa"] > 0 ) {
              $data["Chemical"][$key]["icon"] = "ion-erlenmeyer-flask-bubbles";

          } else {
              $data["Chemical"][$key]["icon"] = "ion-erlenmeyer-flask";
          }
      }

      return view('home')->with('chemicals',$data["Chemical"]);

    }
}

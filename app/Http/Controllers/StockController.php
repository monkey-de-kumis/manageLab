<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chemicals;
use App\Stock;


class StockController extends Controller
{
    //
    public function index() {
      $stocks = Stock::with('chemicals')->orderBy('created_at','DESC')->paginate(10);
      $chemicals = Chemicals::orderby('name','ASC')->get();
      return view('stocks.index', compact('stocks','chemicals'));
    }
    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            //'chemicals_id' =>'required|exists:chemicals,id',
            'qty' => 'required|integer',
            'tgl_masuk' => 'required|date',
        ]);try {
            $stocks = Stock::firstOrCreate([
                'chemicals_id' => $request->chemicals_id,
                'qty' => $request->qty,
                'tgl_masuk'=>$request->tgl_masuk
            ]);
            return redirect()->back()->with(['success' => 'Stock Ditambahkan : '.$stocks->qty ]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $stocks = Package::findOrFail($id);
          $stocks->delete();
          return redirect()->back()->with(['success' => 'Stock: ' . $stocks->qty. ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $stocks = Stock::findOrFail($id);
          $chemicals = Chemicals::orderby('name','ASC')->get();
          return view('stocks.edit', compact('stocks','chemicals'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'chemicals_id' => 'required|string|max:50',

          ]);try {
              //select data berdasarkan id
              $stocks = Package::findOrFail($id);
              //update data
              $stocks->update([
                  'name' => $request->name
              ]);

              //redirect ke route satuan.index
              return redirect(route('satuan.index'))->with(['success' => 'Kemasan: ' . $stocks->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }


}

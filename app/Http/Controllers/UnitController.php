<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    //
    public function index() {
      $units = Unit::orderBy('created_at', 'DESC')->paginate(10);
      return view('units.index', compact('units'));
    }

    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);try {
            $units = Unit::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Satuan: ' . $units->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $units = Unit::findOrFail($id);
          $units->delete();
          return redirect()->back()->with(['success' => 'Satuan: ' . $units->name . ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $units = Unit::findOrFail($id);
          return view('units.edit', compact('units'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'name' => 'required|string|max:50',
              'description' => 'nullable|string'
          ]);try {
              //select data berdasarkan id
              $units = Unit::findOrFail($id);
              //update data
              $units->update([
                  'name' => $request->name,
                  'description' => $request->description
              ]);

              //redirect ke route satuan.index
              return redirect(route('satuan.index'))->with(['success' => 'Satuan: ' . $units->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }

}

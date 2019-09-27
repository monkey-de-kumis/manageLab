<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

class MaterialController extends Controller
{
    //
    public function index() {
      $materials = Material::orderBy('created_at', 'DESC')->paginate(10);
      return view('materials.index', compact('materials'));
    }
    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);try {
            $materials = Material::firstOrCreate([
                'name' => $request->name
            ]);
            return redirect()->back()->with(['success' => 'Bentuk bahan: ' . $materials->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $materials = Material::findOrFail($id);
          $materials->delete();
          return redirect()->back()->with(['success' => 'Bentuk bahan: ' . $materials->name . ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $materials = Material::findOrFail($id);
          return view('units.edit', compact('units'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'name' => 'required|string|max:50',

          ]);try {
              //select data berdasarkan id
              $materials = Material::findOrFail($id);
              //update data
              $materials->update([
                  'name' => $request->name
              ]);

              //redirect ke route satuan.index
              return redirect(route('bahan.index'))->with(['success' => 'Bentuk bahan: ' . $packages->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }
}

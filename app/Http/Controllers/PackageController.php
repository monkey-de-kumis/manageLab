<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;

class PackageController extends Controller
{
    //
    public function index() {
      $packages = Package::orderBy('created_at', 'DESC')->paginate(10);
      return view('packages.index', compact('packages'));
    }

    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);try {
            $packages = Package::firstOrCreate([
                'name' => $request->name
            ]);
            return redirect()->back()->with(['success' => 'Kemasan: ' . $packages->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $packages = Package::findOrFail($id);
          $packages->delete();
          return redirect()->back()->with(['success' => 'Kemasan: ' . $packages->name . ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $packages = Package::findOrFail($id);
          return view('units.edit', compact('units'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'name' => 'required|string|max:50',

          ]);try {
              //select data berdasarkan id
              $packages = Package::findOrFail($id);
              //update data
              $packages->update([
                  'name' => $request->name
              ]);

              //redirect ke route satuan.index
              return redirect(route('satuan.index'))->with(['success' => 'Kemasan: ' . $packages->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }
}

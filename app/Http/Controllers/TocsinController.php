<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tocsin;

class TocsinController extends Controller
{
    //
    public function index() {
      $tocsins = Tocsin::orderBy('created_at', 'DESC')->paginate(10);
      return view('tocsins.index', compact('tocsins'));
    }

    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);try {
            $tocsins = Tocsin::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Tanda Bahaya: ' . $tocsins->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $tocsins = Tocsin::findOrFail($id);
          $tocsins->delete();
          return redirect()->back()->with(['success' => 'Tanda Bahaya: ' . $tocsins->name . ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $tocsins = Tocsin::findOrFail($id);
          return view('tocsins.edit', compact('activities'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'name' => 'required|string|max:50',
              'description' => 'nullable|string'
          ]);try {
              //select data berdasarkan id
              $tocsins = Tocsin::findOrFail($id);
              //update data
              $tocsins->update([
                  'name' => $request->name,
                  'description' => $request->description
              ]);

              //redirect ke route satuan.index
              return redirect(route('tocsins.index'))->with(['success' => 'Tanda Bahaya: ' . $tocsins->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }
}

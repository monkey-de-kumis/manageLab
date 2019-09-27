<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    //
    public function index() {
      $activities = Activity::orderBy('created_at', 'DESC')->paginate(10);
      return view('activities.index', compact('activities'));
    }

    public function store(Request $request) {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);try {
            $activities = Activity::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Penetapan: ' . $activities->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      }

      public function destroy($id)
      {
          $activities = Activity::findOrFail($id);
          $activities->delete();
          return redirect()->back()->with(['success' => 'Penetapan: ' . $activities->name . ' Telah Dihapus']);
      }

      public function edit($id)
      {
          $activities = Activity::findOrFail($id);
          return view('activities.edit', compact('activities'));
      }

      public function update(Request $request, $id)
      {
          //validasi form
          $this->validate($request, [
              'name' => 'required|string|max:50',
              'description' => 'nullable|string'
          ]);try {
              //select data berdasarkan id
              $activities = Activity::findOrFail($id);
              //update data
              $activities->update([
                  'name' => $request->name,
                  'description' => $request->description
              ]);

              //redirect ke route satuan.index
              return redirect(route('activities.index'))->with(['success' => 'Penetapan: ' . $activities->name . ' Ditambahkan']);
          } catch (\Exception $e) {
              //jika gagal, redirect ke form yang sama lalu membuat flash message error
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }

      public function search(Request $request)
      {
        $this->validate($request, [
          'name' => 'required|name'
        ]);

        $activity = Activity::where('name', $request->name)->first();
        if ($activity) {
          return response()->json([
            'status' => 'success',
            'data' => $activity
          ], 200);
        }

        return response()->json([
          'status' => 'failed',
          'data' => []
        ]);
      } 
}

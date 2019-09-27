<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tocsin;
use App\Material;
use App\Package;
use App\Unit;
use App\Chemicals;
//use File;
//use Image;

class ChemicalsController extends Controller
{
    //
    public function index() {
      $chemicals = Chemicals::with('tocsin', 'package',
        'material','unit')->orderBy('created_at','DESC')->paginate(10);
      return view('chemicals.index',compact('chemicals'));
    }

    public function create()
    {
      $units = Unit::orderby('name','ASC')->get();
      $tocsins = Tocsin::orderby('name','ASC')->get();
      $materials = Material::orderby('name','ASC')->get();
      $packages =Package::orderby('name','ASC')->get();
      $data = [
        'units'=>$units,
        'tocsins'=>$tocsins,
        'materials'=>$materials,
        'packages'=>$packages
      ];
      return view('chemicals.create',
          compact('tocsins','materials','packages','units'));

        /*return view('chemicals.create',
                    compact(
                      'units',
                      'tocsins',
                      'materialas',
                      'packages'
                    ));   */
    }

    public function store(Request $request) {
      $this->validate($request, [
        'name'=> 'required|string|max:500',
        'formula'=> 'required|string|max:100',
        'catalog'=> 'required|string|max:100',
        'tocsin_id' =>'required|exists:tocsins,id',
        'package_id' =>'required|exists:packages,id',
        'material_id' =>'required|exists:materials,id',
        'unit_id' =>'required|exists:units,id',
        'volume' => 'required|integer',
      ]);
      try{
        /** for image upload process **/
        //default $photo = null
        /** $photo = null;
        //jika terdapat photo atau gambar yang terkirim
        if ($request->hasFile('photo')) {
          //run action saveFile
          $photo=$this->saveFile($request->name,$request->file('photo'));
        } */

        //Save data to table chemicals
        $chemical = Chemicals::create([
          'name'=> $request->name,
          'description'=> $request->description,
          'formula'=> $request->formula,
          'catalog'=> $request->catalog,
          'tocsin_id'=> $request->tocsin_id,
          'package_id'=> $request->package_id,
          'material_id'=> $request->material_id,
          'unit_id'=> $request->unit_id,
          'volume'=> $request->volume,
          //'photo'=> $photo,
        ]);
        return redirect(route('kimia.index'))
          ->with(['success'=>
              '<strong> '.$chemicals->name .'</strong> ditambahkan']);
        } catch(\Exception $e) {
          //if failed back to back page & display error
          return redirect()->back()
              ->with(['error'=> $e->getMessage()]);
         }

    }

    private function saveFile($name, $option)
    {
      //set file name is combine chemicals name with time.
      //Ektensi image still intact
      $images = str_slug($name) . time() . '.' .
            $photo->getClientOriginalExtension();
      //set path to save images
      $path = public_path('uploads/chemicals');
      //cek if uploads/chemical not a directory / folder
      if(!File::isDirectory($path)) {
        //so create folder
        File::makeDirectory($path, 0777, true, true);
      }
      //copy image to folder uploads/chemicals
      Image::make($photo)->save($path . '/' . $images);
      //return file name on images variable
      return $images;
    }

    public function destroy($id)
    {
      $chemicals = Chemicals::findOrFail($id);
      //if(isset($chemicals->photo)&&!empty($chemicals->photo))
      //{
      //  File::delete(public_path('uploads/chemicals/'.$chemicals->photo));
      //}
      $chemicals->delete();
      return redirect()->back()->with(['success => <strong>'.$chemicals->name.
    ' </strong> telah dihapus']);
    }
    public function edit($id)
    {
      $chemicals =Chemicals::findOrFail($id);
      $units = Unit::orderby('name','ASC')->get();
      $tocsins = Tocsin::orderby('name','ASC')->get();
      $materials = Material::orderby('name','ASC')->get();
      $packages =Package::orderby('name','ASC')->get();
      return view('chemicals.edit',compact('chemicals','tocsins','materials','packages','units'));
    }
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name'=> 'required|string|max:500',
        'formula'=> 'required|string|max:100',
        'catalog'=> 'required|string|max:100',
        'tocsin_id' =>'required|exists:tocsins,id',
        'package_id' =>'required|exists:packages,id',
        'material_id' =>'required|exists:materials,id',
        'unit_id' =>'required|exists:units,id',
        'volume' => 'required|integer',
      ]);
      try{
        $chemicals = Chemicals::findOrFail($id);
        /** $photo = $chemicals->photo;
        //jika terdapat photo atau gambar yang terkirim
        if ($request->hasFile('photo')) {
          //run action saveFile
          isset($photo)&&!empty($photo) ? File::delete(public_path('uploads/chemicals/'.$photo)):null;
          $photo=$this->saveFile($request->name,$request->file('photo'));
        } */
        $chemicals->update([
          'name'=> $request->name,
          'description'=> $request->description,
          'formula'=> $request->formula,
          'catalog'=> $request->catalog,
          'tocsin_id'=> $request->tocsin_id,
          'package_id'=> $request->package_id,
          'material_id'=> $request->material_id,
          'unit_id'=> $request->unit_id,
          'volume'=> $request->volume,
          //'photo'=> $photo,
        ]);
        return redirect(route('kimia.index'))
          ->with(['success'=>
              '<strong> '.$chemicals->name .'</strong> ditambahkan']);


      } catch (\Exception $e){
        //if failed back to back page & display error
        return redirect()->back()
            ->with(['error'=> $e->getMessage()]);

      }
    }
}

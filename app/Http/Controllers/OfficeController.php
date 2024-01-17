<?php
namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
	public function index(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Office::where('name','like','%'.$search.'%')->paginate(10);
        $data->appends(['search' => $search]);

        return view('offices.index',[
            'data' => $data,
            'search' => $search
        ]);
	}

	public function insert(Request $request)
	{
		if($request->isMethod('post'))
		{
			try
			{
				$validator=Validator::make(
					$request->all(),
					[
						'name' => 'required',
						'area' => 'required'
					],
					[
						'name.required' => 'El campo "Nombre" es requerido',
						'area.required' => 'El campo "Área" es requerido'
					]
				);

				if($validator->fails()){
					Session::flash('globalMessage', $validator->errors()->all());
					Session::flash('type', 'error');
					return redirect()->route('offices.index');
				}

				$office=new Office();

				$office->name=trim($request->name);
				$office->area=trim($request->area);
				$office->save();

				Session::flash('globalMessage', ['Operación realizada correctamente.']);
				Session::flash('type', 'success');

				return redirect()->route('offices.index');
			}
			catch(\Exception $e)
			{
				Session::flash('globalMessage', ['Error al crear el registro']);
				Session::flash('type', 'error');
				return redirect()->route('offices.index');
			}
		}

		return view('offices.insert');
	}

	public function edit(Request $request, $id)
    {
        if($request->isMethod('put'))
        {
            try
            {
                $validator=Validator::make(
					$request->all(),
					[
						'name' => 'required',
						'area' => 'required'
					],
					[
						'name.required' => 'El campo "nombre" es requerido',
						'area.required' => 'El campo "Área" es requerido'
					]
				);

                if($validator->fails()){
                    Session::flash('globalMessage', $validator->errors()->all());
                    Session::flash('type', 'error');
                    return redirect()->route('offices.index');
                }

                $office=Office::find($id);
                $office->name=trim($request->name);
                $office->area=trim($request->area);
                $office->save();

                Session::flash('globalMessage', ['Operación realizada correctamente.']);
                Session::flash('type', 'success');

                return redirect()->route('offices.index');
            }
            catch(\Exception $e)
            {
                Session::flash('globalMessage', ['Error al editar el registro']);
                Session::flash('type', 'error');
                return redirect()->route('offices.index');
            }
        }

        $office=Office::find($id);

        return view('offices.edit', ['office' => $office]);
    }

	public function delete($id)
    {
        try{
            $office=Office::find($id);
            if($office->staffs->count()>0)
            {
                Session::flash('globalMessage', ['No se puede eliminar la oficina porque tiene personal asociado.']);
                Session::flash('type', 'error');
                return redirect()->route('offices.index');
            }

            $office->delete();

            Session::flash('globalMessage', ['Operación realizada correctamente.']);
            Session::flash('type', 'success');

            return redirect()->route('offices.index');
        }
        catch(\Exception $e)
        {
            Session::flash('globalMessage', ['Error al eliminar el registro']);
            Session::flash('type', 'error');
            return redirect()->route('offices.index');
        }
    }
}

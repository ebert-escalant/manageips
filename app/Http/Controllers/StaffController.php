<?php
namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Staff::whereRaw('dni=? or fullname like ?',[$search, '%'.$search.'%'])->paginate(10);
        $data->appends(['search' => $search]);

        return view('staffs.index',[
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
						'dni' => ['required', 'regex:/^[0-9]{8}$/'],
						'fullname' => 'required',
						'charge' => 'required',
						'officeId' => ['required', 'exists:offices,id']
					],
					[
						'dni.required' => 'El campo "DNI" es requerido',
						'dni.regex' => 'El campo "DNI" debe tener 8 dígitos',
						'fullname.required' => 'El campo "Nombre completo" es requerido',
						'charge.required' => 'El campo "Cargo" es requerido',
						'officeId.required' => 'El campo "Oficina" es requerido',
						'officeId.exists' => 'El campo "Oficina" es inválido'
					]
				);

				if($validator->fails()){
					Session::flash('globalMessage', $validator->errors()->all());
					Session::flash('type', 'error');
					return redirect()->route('staffs.index');
				}

				$staff=new Staff();

				$staff->dni=trim($request->dni);
				$staff->fullname=trim($request->fullname);
				$staff->charge=trim($request->charge);
				$staff->office_id=trim($request->officeId);

				$staff->save();

				Session::flash('globalMessage', ['Operación realizada correctamente.']);
				Session::flash('type', 'success');

				return redirect()->route('staffs.index');
			}
			catch(\Exception $e)
			{
				Session::flash('globalMessage', ['Error al crear el registro']);
				Session::flash('type', 'error');
				return redirect()->route('staffs.index');
			}
		}

		$offices=Office::all();

		return view('staffs.insert', ['offices' => $offices]);
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
						'dni' => ['required', 'regex:/^[0-9]{8}$/'],
						'fullname' => 'required',
						'charge' => 'required',
						'officeId' => ['required', 'exists:offices,id']
					],
					[
						'dni.required' => 'El campo "DNI" es requerido',
						'dni.regex' => 'El campo "DNI" debe tener 8 dígitos',
						'fullname.required' => 'El campo "Nombre completo" es requerido',
						'charge.required' => 'El campo "Cargo" es requerido',
						'officeId.required' => 'El campo "Oficina" es requerido',
						'officeId.exists' => 'El campo "Oficina" es inválido'
					]
				);

                if($validator->fails()){
                    Session::flash('globalMessage', $validator->errors()->all());
                    Session::flash('type', 'error');
                    return redirect()->route('staffs.index');
                }

                $staff=Staff::find($id);

                $staff->dni=trim($request->dni);
				$staff->fullname=trim($request->fullname);
				$staff->charge=trim($request->charge);
				$staff->office_id=trim($request->officeId);

                $staff->save();

                Session::flash('globalMessage', ['Operación realizada correctamente.']);
                Session::flash('type', 'success');

                return redirect()->route('staffs.index');
            }
            catch(\Exception $e)
            {
                Session::flash('globalMessage', ['Error al editar el registro']);
                Session::flash('type', 'error');
                return redirect()->route('staffs.index');
            }
        }

		$staff=Staff::find($id);
        $offices=Office::all();

        return view('staffs.edit', ['offices' => $offices, 'staff' => $staff]);
    }

	public function delete($id)
    {
        try{
            $staff=Staff::find($id);
            if($staff->devices->count()>0)
            {
                Session::flash('globalMessage', ['No se puede eliminar el registro porque tiene equipos asociados']);
                Session::flash('type', 'error');
                return redirect()->route('staffs.index');
            }

            $staff->delete();

            Session::flash('globalMessage', ['Operación realizada correctamente.']);
            Session::flash('type', 'success');

            return redirect()->route('staffs.index');
        }
        catch(\Exception $e)
        {
            Session::flash('globalMessage', ['Error al eliminar el registro', $e->getMessage()]);
            Session::flash('type', 'error');
            return redirect()->route('staffs.index');
        }
    }
}

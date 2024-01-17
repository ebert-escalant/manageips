<?php
namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NetworkController extends Controller
{
    public function index(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Network::whereRaw('concat(ip, mask, gateway) like ?',['%'.$search.'%'])->paginate(10);
        $data->appends(['search' => $search]);

        return view('networks.index',[
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
						'ip' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
                        'mask' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
                        'gateway' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
					],
					[
						'ip.required' => 'El campo "IP" es requerido',
                        'ip.regex' => 'El campo "IP" no tiene un formato válido',
                        'mask.required' => 'El campo "Máscara" es requerido',
                        'mask.regex' => 'El campo "Máscara" no tiene un formato válido',
                        'gateway.required' => 'El campo "Puerta de enlace" es requerido',
                        'gateway.regex' => 'El campo "Puerta de enlace" no tiene un formato válido'
					]
				);

				if($validator->fails()){
					Session::flash('globalMessage', $validator->errors()->all());
					Session::flash('type', 'error');
					return redirect()->route('networks.index');
				}

				$network=new Network();

				$network->ip=trim($request->ip);
                $network->mask=trim($request->mask);
                $network->gateway=trim($request->gateway);

				$network->save();

				Session::flash('globalMessage', ['Operación realizada correctamente.']);
				Session::flash('type', 'success');

				return redirect()->route('networks.index');
			}
			catch(\Exception $e)
			{
				Session::flash('globalMessage', ['Error al crear el registro']);
				Session::flash('type', 'error');
				return redirect()->route('networks.index');
			}
		}

		return view('networks.insert');
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
						'ip' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
                        'mask' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
                        'gateway' => ['required', 'regex:/^([0-9]{1,3}\.){3}[0-9]{1,3}$/'],
					],
					[
						'ip.required' => 'El campo "IP" es requerido',
                        'ip.regex' => 'El campo "IP" no tiene un formato válido',
                        'mask.required' => 'El campo "Máscara" es requerido',
                        'mask.regex' => 'El campo "Máscara" no tiene un formato válido',
                        'gateway.required' => 'El campo "Puerta de enlace" es requerido',
                        'gateway.regex' => 'El campo "Puerta de enlace" no tiene un formato válido'
					]
				);

                if($validator->fails()){
                    Session::flash('globalMessage', $validator->errors()->all());
                    Session::flash('type', 'error');
                    return redirect()->route('networks.index');
                }

                $network=Network::find($id);
                $network->ip=trim($request->ip);
                $network->mask=trim($request->mask);
                $network->gateway=trim($request->gateway);
                $network->save();

                Session::flash('globalMessage', ['Operación realizada correctamente.']);
                Session::flash('type', 'success');

                return redirect()->route('networks.index');
            }
            catch(\Exception $e)
            {
                Session::flash('globalMessage', ['Error al editar el registro']);
                Session::flash('type', 'error');
                return redirect()->route('networks.index');
            }
        }

        $network=Network::find($id);

        return view('networks.edit', ['network' => $network]);
    }

	public function delete($id)
    {
        try{
            $network=Network::find($id);
            if($network->devices->count()>0)
            {
                Session::flash('globalMessage', ['No se puede eliminar el registro por que tiene equipos asociados.']);
                Session::flash('type', 'error');
                return redirect()->route('networks.index');
            }

            $network->delete();

            Session::flash('globalMessage', ['Operación realizada correctamente.']);
            Session::flash('type', 'success');

            return redirect()->route('networks.index');
        }
        catch(\Exception $e)
        {
            Session::flash('globalMessage', ['Error al eliminar el registro']);
            Session::flash('type', 'error');
            return redirect()->route('networks.index');
        }
    }
}

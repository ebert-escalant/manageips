<?php
namespace App\Http\Controllers;

use App\Exports\DevicesExport;
use App\Models\Device;
use App\Models\Network;
use App\Models\Office;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class DeviceController extends Controller
{
    public function index(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Device::whereRaw('mac=? or concat(brand, model, type) like ?',[$search, '%'.$search.'%'])->paginate(10);
        $data->appends(['search' => $search]);

        return view('devices.index',[
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
						'mac' => ['required'],
						'brand' => 'required',
						'model' => 'nullable',
						'type' => 'nullable',
						'description' => 'nullable',
						'staffId' => ['required', 'exists:staffs,id'],
						'officeId' => ['required', 'exists:offices,id'],
						'networkId' => ['required', 'exists:networks,id']
					],
					[
						'mac.required' => 'El campo "MAC" es requerido',
						'brand.required' => 'El campo "Marca" es requerido',
						'staffId.required' => 'El campo "Personal" es requerido',
						'staffId.exists' => 'El campo "Personal" no tiene un valor válido',
						'officeId.required' => 'El campo "Oficina" es requerido',
						'officeId.exists' => 'El campo "Oficina" no tiene un valor válido',
						'networkId.required' => 'El campo "Red" es requerido',
						'networkId.exists' => 'El campo "Red" no tiene un valor válido'
					]
				);

				if($validator->fails()){
					Session::flash('globalMessage', $validator->errors()->all());
					Session::flash('type', 'error');
					return redirect()->route('devices.index');
				}

				$device=new Device();

				$device->mac=trim($request->mac);
				$device->brand=trim($request->brand);
				$device->model=trim($request->model ?? '');
				$device->type=trim($request->type ?? '');
				$device->description=trim($request->description ?? '');
				$device->staff_id=trim($request->staffId);
				$device->office_id=trim($request->officeId);
				$device->network_id=trim($request->networkId);
				$device->user_id=auth()->user()->id;

				$device->save();

				Session::flash('globalMessage', ['Operación realizada correctamente.']);
				Session::flash('type', 'success');

				return redirect()->route('devices.index');
			}
			catch(\Exception $e)
			{
				Session::flash('globalMessage', ['Error al crear el registro']);
				Session::flash('type', 'error');
				return redirect()->route('devices.index');
			}
		}

		$staffs=Staff::all();
		$offices=Office::all();
		$networks=Network::all();

		return view('devices.insert', [
			'staffs' => $staffs,
			'offices' => $offices,
			'networks' => $networks
		]);
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
						'mac' => ['required'],
						'brand' => 'required',
						'model' => 'nullable',
						'type' => 'nullable',
						'description' => 'nullable',
						'staffId' => ['required', 'exists:staffs,id'],
						'officeId' => ['required', 'exists:offices,id'],
						'networkId' => ['required', 'exists:networks,id']
					],
					[
						'mac.required' => 'El campo "MAC" es requerido',
						'brand.required' => 'El campo "Marca" es requerido',
						'staffId.required' => 'El campo "Personal" es requerido',
						'staffId.exists' => 'El campo "Personal" no tiene un valor válido',
						'officeId.required' => 'El campo "Oficina" es requerido',
						'officeId.exists' => 'El campo "Oficina" no tiene un valor válido',
						'networkId.required' => 'El campo "Red" es requerido',
						'networkId.exists' => 'El campo "Red" no tiene un valor válido'
					]
				);

                if($validator->fails()){
                    Session::flash('globalMessage', $validator->errors()->all());
                    Session::flash('type', 'error');
                    return redirect()->route('devices.index');
                }

                $device=Device::find($id);
                $device->mac=trim($request->mac);
				$device->brand=trim($request->brand);
				$device->model=trim($request->model ?? '');
				$device->type=trim($request->type ?? '');
				$device->description=trim($request->description ?? '');
				$device->staff_id=trim($request->staffId);
				$device->office_id=trim($request->officeId);
				$device->network_id=trim($request->networkId);
                $device->save();

                Session::flash('globalMessage', ['Operación realizada correctamente.']);
                Session::flash('type', 'success');

                return redirect()->route('devices.index');
            }
            catch(\Exception $e)
            {
                Session::flash('globalMessage', ['Error al editar el registro']);
                Session::flash('type', 'error');
                return redirect()->route('devices.index');
            }
        }

        $device=Device::find($id);
		$staffs=Staff::all();
		$offices=Office::all();
		$networks=Network::all();

        return view('devices.edit', [
			'device' => $device,
			'staffs' => $staffs,
			'offices' => $offices,
			'networks' => $networks
		]);
    }

	public function delete($id)
    {
        try{
            $device=Device::find($id);

            $device->delete();

            Session::flash('globalMessage', ['Operación realizada correctamente.']);
            Session::flash('type', 'success');

            return redirect()->route('devices.index');
        }
        catch(\Exception $e)
        {
            Session::flash('globalMessage', ['Error al eliminar el registro']);
            Session::flash('type', 'error');
            return redirect()->route('devices.index');
        }
    }

	public function exportpdf(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Device::whereRaw('mac=? or concat(brand, model, type) like ?',[$search, '%'.$search.'%'])->get();
		$pdf = Pdf::loadView('devices.exportpdf', ['data' => $data]);

		return $pdf->stream('reporte-inventario'.date('Y-m-d'), ['attachment' => false]);
	}

	public function exportcsv(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Device::whereRaw('mac=? or concat(brand, model, type) like ?',[$search, '%'.$search.'%'])->get();

		return Excel::download(new DevicesExport($data), 'reporte-inventario'.date('Y-m-d H:i').'.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
	}

	public function exportexcel(Request $request)
	{
		$search=$request->has('search') ? $request->input('search') : '';
        $data=Device::whereRaw('mac=? or concat(brand, model, type) like ?',[$search, '%'.$search.'%'])->get();

		return Excel::download(new DevicesExport($data), 'reporte-inventario'.date('Y-m-d H:i').'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
	}
}

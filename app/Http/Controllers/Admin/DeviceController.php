<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', compact('devices'));
    }

    public function create()
    {
        $models=['Prototipo 1','Prototipo 2'];
        return view('admin.devices.create', compact('models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:devices',
            'model' => 'required',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')
                         ->with('success', 'Device created successfully.');
    }

    public function show(Device $device)
    {
        return view('admin.devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $models=['Prototipo 1','Prototipo 2'];        
        return view('admin.devices.edit', compact('device','models'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' =>  'required|unique:devices',
            'model' => 'required',
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')
                         ->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
                         ->with('success', 'Device deleted successfully.');
    }
}

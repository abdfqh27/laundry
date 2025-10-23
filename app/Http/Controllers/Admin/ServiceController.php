<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaundryService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = LaundryService::orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        LaundryService::create($validated);

        return redirect()->route('admin.services')
            ->with('success', 'Service berhasil ditambahkan!');
    }

    public function show($id)
    {
        $service = LaundryService::with('orderItems')->findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    public function edit($id)
    {
        $service = LaundryService::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = LaundryService::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $service->update($validated);

        return redirect()->route('admin.services')
            ->with('success', 'Service berhasil diupdate!');
    }

    public function destroy($id)
    {
        $service = LaundryService::findOrFail($id);
        
        // Check if service has related orders
        if ($service->orderItems()->count() > 0) {
            return redirect()->route('admin.services')
                ->with('error', 'Service tidak dapat dihapus karena memiliki data order terkait!');
        }

        $service->delete();

        return redirect()->route('admin.services')
            ->with('success', 'Service berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $service = LaundryService::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();

        return redirect()->route('admin.services')
            ->with('success', 'Status service berhasil diubah!');
    }
}
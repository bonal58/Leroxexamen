<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('name')->paginate(12);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        // Verwerk de afbeelding als deze is geüpload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }
        
        Service::create($validated);
        
        return redirect()->route('services.index')
            ->with('success', __('messages.service_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        // Verwerk de afbeelding als deze is geüpload
        if ($request->hasFile('image')) {
            // Verwijder de oude afbeelding als deze bestaat
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }
        
        $service->update($validated);
        
        return redirect()->route('services.index')
            ->with('success', __('messages.service_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Verwijder de afbeelding als deze bestaat
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();
        
        return redirect()->route('services.index')
            ->with('success', __('messages.service_deleted'));
    }
}

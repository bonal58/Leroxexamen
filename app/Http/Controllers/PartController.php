<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Photo;
use App\Models\Scooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Part::orderBy('name')->paginate(12);
        return view('parts.index', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scooters = Scooter::orderBy('name')->get();
        return view('parts.create', compact('scooters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'compatible_scooters' => 'nullable|array',
            'compatible_scooters.*' => 'exists:scooters,id',
        ]);
        
        // Maak het onderdeel aan
        $part = Part::create($validated);
        
        // Verwerk de foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = 0;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $maxPhotos);
            
            foreach ($photos as $photo) {
                $path = $photo->store('parts', 'public');
                
                // Maak de eerste foto primair
                $isPrimary = $order === 0;
                
                // Sla de foto op in de database
                $part->photos()->create([
                    'path' => $path,
                    'is_primary' => $isPrimary,
                    'order' => $order++,
                ]);
                
                // Sla de eerste foto ook op in het image veld voor backward compatibility
                if ($isPrimary) {
                    $part->update(['image' => $path]);
                }
            }
        }
        
        // Koppel compatibele scooters
        if ($request->has('compatible_scooters')) {
            $part->compatibleScooters()->sync($request->compatible_scooters);
        }
        
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Part $part)
    {
        // Laad compatibele scooters
        $part->load('compatibleScooters');
        
        return view('parts.show', compact('part'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Part $part)
    {
        $scooters = Scooter::orderBy('name')->get();
        $part->load('compatibleScooters');
        return view('parts.edit', compact('part', 'scooters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'compatible_scooters' => 'nullable|array',
            'compatible_scooters.*' => 'exists:scooters,id',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:photos,id',
            'primary_photo' => 'nullable|integer|exists:photos,id',
        ]);
        
        // Update het onderdeel
        $part->update($validated);
        
        // Verwijder geselecteerde foto's
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = Photo::find($photoId);
                if ($photo && $photo->photoable_id == $part->id) {
                    // Verwijder de foto van de schijf
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }
            }
        }
        
        // Verwerk de nieuwe foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = $part->photos()->max('order') + 1;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Calculate how many photos we can still add
            $currentPhotoCount = $part->photos()->count();
            $remainingSlots = max(0, $maxPhotos - $currentPhotoCount);
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $remainingSlots);
            
            foreach ($photos as $photo) {
                $path = $photo->store('parts', 'public');
                
                // Sla de foto op in de database
                $part->photos()->create([
                    'path' => $path,
                    'is_primary' => false, // Standaard niet primair
                    'order' => $order++,
                ]);
            }
        }
        
        // Update de primaire foto als deze is geselecteerd
        if ($request->has('primary_photo')) {
            // Reset alle primaire foto's
            $part->photos()->update(['is_primary' => false]);
            
            // Zet de geselecteerde foto als primair
            $photo = Photo::find($request->primary_photo);
            if ($photo && $photo->photoable_id == $part->id) {
                $photo->update(['is_primary' => true]);
                $part->update(['image' => $photo->path]); // Voor backward compatibility
            }
        }
        
        // Koppel compatibele scooters
        if ($request->has('compatible_scooters')) {
            $part->compatibleScooters()->sync($request->compatible_scooters);
        } else {
            $part->compatibleScooters()->detach();
        }
        
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        // Verwijder alle foto's
        foreach ($part->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        
        // Verwijder de oude afbeelding als deze bestaat (voor backward compatibility)
        if ($part->image) {
            Storage::disk('public')->delete($part->image);
        }
        
        // Ontkoppel alle relaties
        $part->compatibleScooters()->detach();
        
        $part->delete();
        
        return redirect()->route('parts.index')
            ->with('success', __('messages.part_deleted'));
    }
}

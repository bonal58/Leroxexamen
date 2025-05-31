<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Scooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ScooterController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scooters = Scooter::orderBy('featured', 'desc')->orderBy('name')->paginate(12);
        return view('scooters.index', compact('scooters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scooters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'featured' => 'boolean',
        ]);
        
        // Zet featured op false als het niet is aangevinkt
        $validated['featured'] = $request->has('featured');
        
        // Maak de scooter aan
        $scooter = Scooter::create($validated);
        
        // Verwerk de foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = 0;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $maxPhotos);
            
            foreach ($photos as $photo) {
                $path = $photo->store('scooters', 'public');
                
                // Maak de eerste foto primair
                $isPrimary = $order === 0;
                
                // Sla de foto op in de database
                $scooter->photos()->create([
                    'path' => $path,
                    'is_primary' => $isPrimary,
                    'order' => $order++,
                ]);
                
                // Sla de eerste foto ook op in het image veld voor backward compatibility
                if ($isPrimary) {
                    $scooter->update(['image' => $path]);
                }
            }
        }
        
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Scooter $scooter)
    {
        // Laad compatibele onderdelen
        $scooter->load('compatibleParts');
        
        return view('scooters.show', compact('scooter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scooter $scooter)
    {
        return view('scooters.edit', compact('scooter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scooter $scooter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048',
            'featured' => 'boolean',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:photos,id',
            'primary_photo' => 'nullable|integer|exists:photos,id',
        ]);
        
        // Zet featured op false als het niet is aangevinkt
        $validated['featured'] = $request->has('featured');
        
        // Update de scooter
        $scooter->update($validated);
        
        // Verwijder geselecteerde foto's
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = Photo::find($photoId);
                if ($photo && $photo->photoable_id == $scooter->id) {
                    // Verwijder de foto van de schijf
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }
            }
        }
        
        // Verwerk de nieuwe foto's als deze zijn geüpload
        if ($request->hasFile('photos')) {
            $order = $scooter->photos()->max('order') + 1;
            $maxPhotos = $request->input('max_photos', 10); // Default to 10 if not specified
            
            // Calculate how many photos we can still add
            $currentPhotoCount = $scooter->photos()->count();
            $remainingSlots = max(0, $maxPhotos - $currentPhotoCount);
            
            // Limit the number of photos to process
            $photos = array_slice($request->file('photos'), 0, $remainingSlots);
            
            foreach ($photos as $photo) {
                $path = $photo->store('scooters', 'public');
                
                // Sla de foto op in de database
                $scooter->photos()->create([
                    'path' => $path,
                    'is_primary' => false, // Standaard niet primair
                    'order' => $order++,
                ]);
            }
        }
        
        // Update de primaire foto als deze is geselecteerd
        if ($request->has('primary_photo')) {
            // Reset alle primaire foto's
            $scooter->photos()->update(['is_primary' => false]);
            
            // Zet de geselecteerde foto als primair
            $photo = Photo::find($request->primary_photo);
            if ($photo && $photo->photoable_id == $scooter->id) {
                $photo->update(['is_primary' => true]);
                $scooter->update(['image' => $photo->path]); // Voor backward compatibility
            }
        }
        
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scooter $scooter)
    {
        // Verwijder alle foto's
        foreach ($scooter->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }
        
        // Verwijder de oude afbeelding als deze bestaat (voor backward compatibility)
        if ($scooter->image) {
            Storage::disk('public')->delete($scooter->image);
        }
        
        $scooter->delete();
        
        return redirect()->route('scooters.index')
            ->with('success', __('messages.scooter_deleted'));
    }
}

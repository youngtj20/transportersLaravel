<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuItem;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MenuItem::with('children');

        // Filter by parent_id to get top-level menu items or children of specific parent
        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        } else {
            $query->whereNull('parent_id');
        }

        // Filter by menu type if specified
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $menuItems = $query->orderBy('order', 'asc')->get();

        return $this->success(MenuItemResource::collection($menuItems));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $menuItem = MenuItem::create([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
            'type' => $request->type ?? 'main',
            'icon' => $request->icon,
            'target' => $request->target ?? '_self',
        ]);

        return $this->success(new MenuItemResource($menuItem), 'Menu item created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menuItem = MenuItem::with(['children', 'parent'])->find($id);

        if (!$menuItem) {
            return $this->error('Menu item not found', 404);
        }

        return $this->success(new MenuItemResource($menuItem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuItemRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return $this->error('Menu item not found', 404);
        }

        $menuItem->update([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'type' => $request->type,
            'icon' => $request->icon,
            'target' => $request->target,
        ]);

        return $this->success(new MenuItemResource($menuItem), 'Menu item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return $this->error('Menu item not found', 404);
        }

        // Delete children first
        $menuItem->children()->delete();
        
        $menuItem->delete();

        return $this->success(null, 'Menu item deleted successfully');
    }
}

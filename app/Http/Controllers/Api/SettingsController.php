<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Setting::query();

        // Filter by group if specified
        if ($request->has('group')) {
            $query->where('group', $request->group);
        }

        // Filter by type if specified
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $settings = $query->orderBy('key', 'asc')->get();

        return $this->success(SettingResource::collection($settings));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        // Check if setting with this key already exists
        if (Setting::where('key', $request->key)->exists()) {
            return $this->error('Setting with this key already exists', 400);
        }

        $setting = Setting::create([
            'key' => $request->key,
            'value' => $request->value,
            'type' => $request->type ?? 'string',
            'group' => $request->group ?? 'general',
            'description' => $request->description,
        ]);

        return $this->success(new SettingResource($setting), 'Setting created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return $this->error('Setting not found', 404);
        }

        return $this->success(new SettingResource($setting));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $setting = Setting::find($id);

        if (!$setting) {
            return $this->error('Setting not found', 404);
        }

        $setting->update([
            'value' => $request->value,
            'type' => $request->type,
            'group' => $request->group,
            'description' => $request->description,
        ]);

        return $this->success(new SettingResource($setting), 'Setting updated successfully');
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

        $setting = Setting::find($id);

        if (!$setting) {
            return $this->error('Setting not found', 404);
        }

        $setting->delete();

        return $this->success(null, 'Setting deleted successfully');
    }
}

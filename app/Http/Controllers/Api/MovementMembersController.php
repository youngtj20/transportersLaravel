<?php

namespace App\Http\Controllers\Api;

use App\Models\MovementMember;
use App\Http\Requests\MovementMemberRequest;
use App\Http\Resources\MovementMemberResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementMembersController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MovementMember::query();

        // Filter by state if specified
        if ($request->has('state')) {
            $query->where('state', $request->state);
        }

        // Filter by lga if specified
        if ($request->has('lga')) {
            $query->where('lga', $request->lga);
        }

        $movementMembers = $query->orderBy('last_name', 'asc')->get();

        return $this->success(MovementMemberResource::collection($movementMembers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovementMemberRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $movementMember = MovementMember::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'state' => $request->state,
            'lga' => $request->lga,
            'ward' => $request->ward,
            'unit' => $request->unit,
            'modes_of_transport' => $request->modes_of_transport,
        ]);

        return $this->success(new MovementMemberResource($movementMember), 'Movement member created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movementMember = MovementMember::find($id);

        if (!$movementMember) {
            return $this->error('Movement member not found', 404);
        }

        return $this->success(new MovementMemberResource($movementMember));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovementMemberRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $movementMember = MovementMember::find($id);

        if (!$movementMember) {
            return $this->error('Movement member not found', 404);
        }

        $movementMember->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'state' => $request->state,
            'lga' => $request->lga,
            'ward' => $request->ward,
            'unit' => $request->unit,
            'modes_of_transport' => $request->modes_of_transport,
        ]);

        return $this->success(new MovementMemberResource($movementMember), 'Movement member updated successfully');
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

        $movementMember = MovementMember::find($id);

        if (!$movementMember) {
            return $this->error('Movement member not found', 404);
        }

        $movementMember->delete();

        return $this->success(null, 'Movement member deleted successfully');
    }
}

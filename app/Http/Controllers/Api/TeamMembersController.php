<?php

namespace App\Http\Controllers\Api;

use App\Models\TeamMember;
use App\Http\Requests\TeamMemberRequest;
use App\Http\Resources\TeamMemberResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamMembersController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->has('published')) {
            $query->where('published', $request->published === 'true');
        }

        $teamMembers = $query->orderBy('name', 'asc')->get();

        return $this->success(TeamMemberResource::collection($teamMembers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamMemberRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $teamMember = TeamMember::create([
            'name' => $request->name,
            'position' => $request->position,
            'bio' => $request->bio,
            'image' => $request->image,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'published' => $request->published ?? true,
        ]);

        return $this->success(new TeamMemberResource($teamMember), 'Team member created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return $this->error('Team member not found', 404);
        }

        return $this->success(new TeamMemberResource($teamMember));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamMemberRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return $this->error('Unauthorized', 401);
        }

        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return $this->error('Team member not found', 404);
        }

        $teamMember->update([
            'name' => $request->name,
            'position' => $request->position,
            'bio' => $request->bio,
            'image' => $request->image,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'published' => $request->published,
        ]);

        return $this->success(new TeamMemberResource($teamMember), 'Team member updated successfully');
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

        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return $this->error('Team member not found', 404);
        }

        $teamMember->delete();

        return $this->success(null, 'Team member deleted successfully');
    }
}

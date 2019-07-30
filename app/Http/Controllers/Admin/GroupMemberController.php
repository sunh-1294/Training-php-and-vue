<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupUserRequest;
use App\Repositories\Group\GroupRepository;

class GroupMemberController extends Controller
{
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index($group_id)
    {
        $group = $this->groupRepository->findOrFail($group_id);
        $users = $group->users()->paginate(10);

        return view('admin.group_members.index', ['users' => $users, 'group' => $group]);
    }

    public function create($group_id)
    {
        return view('admin.group_members.create', ['group_id' => $group_id]);
    }

    public function store($group_id, GroupUserRequest $request)
    {
        $group = $this->groupRepository->findOrFail($group_id);
        $group->users()->create($request->all());

        return redirect()->route('groups.members.index', $group_id);
    }

    public function destroy($group_id, Request $request, $user_id)
    {
        $group = $this->groupRepository->findOrFail($group_id);
        $groupUser = $group->groupUsers()->where('user_id', $user_id)->firstOrFail();
        $groupUser->delete();

        return redirect()->route('groups.members.index', $group_id);
    }
}

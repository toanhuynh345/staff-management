<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\UserTeamProject;
use App\Repositories\UserTeamProject\UserTeamProjectRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\UserTeamProjectResource;

class UserTeamProjectController extends Controller
{

    protected $userTeamProjectRepo;

    public function __construct(UserTeamProjectRepositoryInterface $userTeamProjectRepo)
    {
        $this->userTeamProjectRepo = $userTeamProjectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->only(['pagination', 'limit']);
        $users = $this->userTeamProjectRepo->getAll($data);
        return res_success($users, __('text.success'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $user = UserTeamProject::create($data);
            return res_success(new UserTeamProjectResource($user),__('messages.create_record_success'));
        }
        catch (\Exception $exception) {
            return res_error($exception->getMessage());
        }
    }


    public function show(UserTeamProject $user_team_project)
    {
        return res_success(new UserTeamProjectResource($user_team_project), __('text.success'),200);
    }


    public function update(Request $request, UserTeamProject $user_team_project)
    {
        $user_team_project->update($request->all());

        return res_success(new UserTeamProjectResource($user_team_project), __('text.success'), 200);
    }


    public function destroy(UserTeamProject $user_team_project)
    {
        $user_team_project->delete();
        return res_success([], __('text.success'));
    }



}

<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\TeamProject;
use App\Repositories\TeamProject\TeamProjectRepository;
use App\Http\Resources\TeamProjectResource;
use App\Http\Requests\TeamProjectRequest;
use Illuminate\Http\Request;


class TeamProjectController extends Controller
{

    protected $teamProjectRepo;

    public function __construct(TeamProjectRepository $teamProjectRepo)
    {
        $this->teamProjectRepo = $teamProjectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->only(['pagination', 'limit']);
        $teamProjects = $this->teamProjectRepo->getTeamProjects($data);
        return res_success($teamProjects, __('text.success'));
    }

    public function store(TeamProjectRequest $request)
    {
        try {
            $data = $request->only(['name', 'department_id', 'project_id']);
            $data['password'] = bcrypt($request->password);
            $user = TeamProject::create($data);
            return res_success(new TeamProjectResource($user), __('messages.create_account_success'));
        }
        catch (\Exception $exception) {
            return res_error($exception->getMessage());
        }
    }


    public function show(TeamProject $project)
    {
        return res_success(new TeamProjectResource($project), __('text.success'),200);
    }


    public function update(Request $request, TeamProject $project)
    {
        $project->update($request->all());

        return res_success(new TeamProjectResource($project), __('text.success'), 200);
    }


    public function destroy(TeamProject $project)
    {
        $project->delete();

        return res_success([], __('text.success'));
    }



}

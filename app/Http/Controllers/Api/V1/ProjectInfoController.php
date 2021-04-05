<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\ProjectInfo;
use App\Repositories\ProjectInfo\ProjectInfoRepository;
use App\Http\Resources\ProjectInfoResource;
use App\Http\Requests\ProjectInfoRequest;
use Illuminate\Http\Request;


class ProjectInfoController extends Controller
{

    protected $projectInfoRepo;

    public function __construct(ProjectInfoRepository $projectInfoRepo)
    {
        $this->projectInfoRepo = $projectInfoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->only(['pagination', 'limit']);
        $projects = $this->projectInfoRepo->getProjects($data);
        return res_success($projects, __('text.success'));
    }

    public function store(ProjectInfoRequest $request)
    {
        try {
            $data = $request->only(['name', 'start_time', 'end_time']);
            $project = ProjectInfo::create($data);
            return res_success(new ProjectInfoResource($project), __('messages.create_account_success'));
        }
        catch (\Exception $exception) {
            return res_error($exception->getMessage());
        }
    }


    public function show(ProjectInfo $project)
    {
        return res_success(new ProjectInfoResource($project), __('text.success'),200);
    }


    public function update(Request $request, ProjectInfo $project)
    {
        $project->update($request->all());

        return res_success(new ProjectInfoResource($project), __('text.success'), 200);
    }


    public function destroy(ProjectInfo $project)
    {
        $project->delete();

        return res_success([], __('text.success'));
    }



}

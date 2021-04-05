<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Repositories\Department\DepartmentRepository;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{

    protected $departmentRepo;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->only(['pagination', 'limit']);
        $departments = $this->departmentRepo->getList($data);
        return res_success($departments, __('text.success'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $data = $request->only(['name', 'user_management_id']);
            $department = Department::create($data);
            return res_success(new DepartmentResource($department), __('messages.create_record_success'));
        }
        catch (\Exception $exception) {
            return res_error($exception->getMessage());
        }
    }


    public function show(Department $department)
    {
        return res_success(new DepartmentResource($department), __('text.success'),200);
    }


    public function update(Request $request, Department $department)
    {
        $department->update($request->all());

        return res_success(new DepartmentResource($department), __('text.success'), 200);
    }


    public function destroy(Department $department)
    {
        $department->delete();

        return res_success([], __('text.success'));
    }



}

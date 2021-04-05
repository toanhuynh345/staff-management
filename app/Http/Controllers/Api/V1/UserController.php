<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->only(['pagination', 'limit']);
        $users = $this->userRepo->getList($data);
        return res_success($users, __('text.success'));
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->only(['name', 'email', 'phone', 'birthday', 'sex', 'description', 'avatar']);
            $data['password'] = bcrypt('123456');
            $user = User::create($data);
            return res_success(new UserResource($user),__('messages.create_record_success'));
        }
        catch (\Exception $exception) {
            return res_error($exception->getMessage());
        }
    }


    public function show(User $user)
    {
        return res_success(new UserResource($user), __('text.success'),200);
    }


    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return res_success(new UserResource($user), __('text.success'), 200);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return res_success([], __('text.success'));
    }



}

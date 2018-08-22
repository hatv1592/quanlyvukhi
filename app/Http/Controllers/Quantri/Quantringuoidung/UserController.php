<?php


namespace App\Http\Controllers\Quantri\Quantringuoidung;


use App\Http\Controllers\Controller;
use App\Http\Requests\CoVuKhiFormRequest;
use App\Model\RoleModel;
use App\Model\RoleUserModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    /**
     * View all user screen
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
         $users = User::paginate(10);
        $roles = RoleModel::pluck('display_name', 'id');

        return view('quantri.thanhvien.index')
            ->with('users', $users)
            ->with('roles', $roles);
    }

    /**
     * Create new a user
     *
     * @param  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $data = $request->input();
        $validator = Validator::make($request->all(), User::rulesCreate('create'), User::message('create'));
        //Nếu sai
        $validator->setAttributeNames(User::setAttributeNames());
        if ($validator->fails()) {
            return redirect()->route('quantri.quantringuoidung.user.index')
                ->withInput()->withErrors($validator);
        }
        try {
            $userModel = new User();
            $userModel->name = $data['user_name'];
            $userModel->email = $data['user_email'];
            $userModel->password = Hash::make(($data['user_password']));
            $userModel->status = (isset($data['user_active'])) ? 1 : 0;
            $userModel->role = $data['role'];
            if ($userModel->save()) {
                return redirect()->route('quantri.quantringuoidung.user.index')
                    ->with('flash_message_success', 'Thêm thành  thành viên');
            }
        } catch
        (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Edit screen
     *
     * @param int $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $user = User::find($id);
        $roles = RoleModel::pluck('display_name', 'id');
        return view('quantri.thanhvien.view')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    /**
     * Update a user
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        $validator = Validator::make($request->all(), User::rulesCreate('update', $id), User::message('create'));
        //Nếu sai
        $validator->setAttributeNames(User::setAttributeNames());
        if ($validator->fails()) {
            return redirect()->route('quantri.quantringuoidung.user.view', $id)
                ->withInput()->withErrors($validator);
        }
        try {
            $userModel = User::find($id);
            $userModel->name = $data['user_name'];
            $userModel->status = (isset($data['user_active'])) ? 1 : 0;
            $userModel->role = $data['role'];
            if ($userModel->save()) {
                return redirect()->route('quantri.quantringuoidung.user.index')
                    ->with('flash_message_success', 'Sửa thành công thành viên');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete a covukhi by it's ID
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return redirect()->route('quantri.quantringuoidung.user.index')
                ->with('flash_message_success', 'Xóa thành công!');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


}
<?php

namespace App\Http\Controllers\Helpdesk;

use App\Exceptions\Helpdesk\ResourceNotFoundHttpException;
use App\Http\Requests\Helpdesk\Department\Delete;
use App\Http\Requests\Helpdesk\Department\Index;
use App\Http\Requests\Helpdesk\Department\Create;
use App\Http\Requests\Helpdesk\Department\Read;
use App\Http\Requests\Helpdesk\Department\Update;
use App\Models\Helpdesk\Department;
use Illuminate\Routing\Controller;
use Throwable;

class DepartmentController extends Controller
{
    /**
     * @param Index $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Index $request)
    {
        $resultsPerPage = 10;
        if ($filterPageResults = $request->get('per_page')) {
            $resultsPerPage = $filterPageResults;
        }
        $collection = Department::Paginate($resultsPerPage);
//        if ($search = $request->get('search')){
//            $collection = Department::search($search)->paginate($resultsPerPage);
//        }
        return response()->json($collection);

    }

    /**
     * @param Create $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function create(Create $request)
    {
        $department = new Department();
        foreach (Department::FILLABLE as $key) {
            $department->setAttribute($key, $request->get($key));
        }
        $department->save();
        return response()->json(['message' => 'Department created.' . $department->getAttribute(Department::FIELD_ID)], 201);
    }

    /**
     * @param Read $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(Read $request)
    {
        $department = Department::find($request->get('department_id'));
        if (!empty($department)) {
            return response()->json($department);
        }
        throw new ResourceNotFoundHttpException();
    }

    /**
     * @param Update $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request)
    {
        $department = Department::find($request->get('department_id'));
        if (!empty($department)) {
            foreach (Department::FILLABLE as $key) {
                if (!empty($request->get($key))) {
                    $department->setAttribute($key, $request->get($key))->save();
                }
            }
            return response()->json(['message' => 'Department updated.'], 201);
        }
        throw new ResourceNotFoundHttpException();
    }

    /**
     * @param Delete $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Delete $request)
    {
        $department = Department::find($request->get('department_id'));
        if (!empty($department)) {
            $department->delete();
            return response()->json(['message' => 'Department deleted.'], 201);
        }
        throw new ResourceNotFoundHttpException();
    }

}

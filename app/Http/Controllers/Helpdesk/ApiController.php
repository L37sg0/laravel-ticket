<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Requests\Helpdesk\CreateRequest;
use App\Http\Requests\Helpdesk\DeleteRequest;
use App\Http\Requests\Helpdesk\ExportRequest;
use App\Http\Requests\Helpdesk\ImportRequest;
use App\Http\Requests\Helpdesk\IndexRequest;
use App\Http\Requests\Helpdesk\ReadRequest;
use App\Http\Requests\Helpdesk\UpdateRequest;
use Illuminate\Routing\Controller;

abstract class ApiController extends Controller
{
    public function __construct(
        protected string $slug ,
        protected string $index,
        protected $modelClass,
        protected $config
    )
    {

    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
    {

        $resultsPerPage = 10;
        if ($filterPageResults = $request->get('per_page')) {
            $resultsPerPage = $filterPageResults;
        }
        $collection = $this->modelClass::Paginate($resultsPerPage);
        // TODO implement search functionality
//        if ($search = $request->get('search')){
//            $collection = $this->modelClass::search($search)->paginate($resultsPerPage);
//        }
        return response()->json($collection);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request)
    {
        return response()->json(["$this->slug created. " . $this->hydrateAndSave($request)]);
    }

    /**
     * @param ReadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(ReadRequest $request)
    {
        $model = $this->modelClass::find($request->get($this->index));
        return response()->json(collect($model));
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        return response()->json(["$this->slug updated. " . $this->hydrateAndSave($request)]);
    }

    /**
     * @param DeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteRequest $request)
    {
        $model = $this->modelClass::find($request->get($this->index));
        $model->delete();
        return response()->json(['message' => "$this->slug deleted."], 201);
    }

    /**
     * @param ExportRequest $request
     * @return void
     */
    public function export(ExportRequest $request)
    {
        // TODO Implement export action
    }

    /**
     * @param ImportRequest $request
     * @return void
     */
    public function import(ImportRequest $request)
    {
        // TODO Implement import action
    }

    /**
     * @param $request
     * @return mixed
     */
    public function hydrateAndSave($request)
    {
        $model = $this->modelClass::firstOrNew(['id' => $request->get($this->index)]);
        foreach ($model->getFillable() as $key) {
            if (array_key_exists($key, $request->all())) {
                $model->setAttribute($key, $request->get($key));
            }
        }
        $model->save();

        return $model->getAttribute('id');
    }
}

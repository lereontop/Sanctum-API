<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(
            Task::where('user_id', Auth::user()->id)->get()
        );
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $storeTaskRequest)
    {
        $storeTaskRequest->validated($storeTaskRequest->all());
        $task = Task::create([
            'user_id' => Auth::user()->id,
            'name'=> $storeTaskRequest->name,
            'descriptin' => $storeTaskRequest->descriptin,
            'priority' => $storeTaskRequest->priority

        ]);

        return new TaskResource($task);


    }
    public function show(Task $task)
    {

       return $this->isNotAuthorize($task) ? $this->isNotAuthorize($task) : new TaskResource($task);
    }


    public function update(Request $request, Task $task)
    {
        if(Auth::user()->id !== $task->user_id){
            return $this->erorr('', 'You are not Authorized to make this request', 403);

        }

        $task->update($request->all());
        return new TaskResource($task);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {


        return $this->isNotAuthorize($task) ? $this->isNotAuthorize($task) :$task->delete();
    }


    private function isNotAuthorize($task){

        if(Auth::user()->id !== $task->user_id){
            return $this->erorr('', 'You are not Authorized to make this request', 403);

        }


    }
}

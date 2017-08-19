<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;    // 追加

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255',   // 追加
            'status' => 'required|max:10',
        ]);

        /*
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;    // 追加
        $task->save();
        */
        
        //エラーハンドリングは未実装
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$task = Task::find($id);
        $user = \Auth::user();
        $task = Task::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
        
        if ($task != null) {
            return view('tasks.show', [
                'task' => $task,
                'user' => $user,
            ]); 
        } else {
            //エラー表示は未実装
            return redirect('/');
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$task = Task::find($id);
        $user = \Auth::user();
        $task = Task::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
                    
        if ($task != null) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        } else {
            //エラー表示は未実装
            return redirect('/');            
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:255',   // 追加
            'status' => 'required|max:10',
        ]);
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->status = $request->status;
        
        //エラーハンドリングは未実装
        $task->save();
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        
        //エラーハンドリングは未実装
        $task->delete();
        return redirect('/');
    }
}

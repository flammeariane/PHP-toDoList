<?php

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archive = Task::where('archive',true)->orderBy('due_date','asc')->paginate(5);
        $tasks = Task::where('archive',false)->orderBy('due_date','asc')->paginate(5);
        return view('tasks.index', compact('archive','tasks'));
    }

    public function goArchive($id,$state){
        Task::findOrFail($id)->update(['archive'=>$state]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $this->validate($request,[
            'name'=>'required|string|max:255|min:3',
            'description'=>'required|string|max:10000|min:10',
            'due_date'=>'required|date',
        ]);

        //create new task
        $task = new Task;

        // assign task from our request
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        //save the data 
        $task->save();

        // flash session message whit succes 
        session::flash('success', 'Created Task Successfully');
        //return a redirection

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //search for the task whit ID
        // return view(show.blade.php)
        //pass with the return the variable that containe the specifique task

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $task->dueDateFormatting= false;
        return view ('tasks.edit')->withTask($task);
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
         //validate data
         $this->validate($request,[
            'name'=>'required|string|max:255|min:3',
            'description'=>'required|string|max:10000|min:10',
            'due_date'=>'required|date',
        ]);

        //find the related  task
        $task = Task::find($id);

        // assign task from our request
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        //save the data 
        $task->save();

        // flash session message whit succes 
        session::flash('success', 'Saved Task Successfully');
        //return a redirection

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // fiding the task
        $task = Task::find($id);

        //deleting the task
        $task->delete();

        //flashing a session message
        Session::flash('success', 'Deleted task successfully');

        // returning a redirect back to index
    return redirect()->route('task.index');
    }
}

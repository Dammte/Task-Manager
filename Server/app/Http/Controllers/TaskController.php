<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // Obtener todas las tareas
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // Crear una nueva tarea
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'responsable' => 'required|string',
            'fechaLimite' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'creation_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => $request->input('status'),
            'responsable' => $request->input('responsable'),
            'fechaLimite' => $request->input('fechaLimite')
        ]);

        return response()->json([
            'task' => $task,
            'csrf_token' => csrf_token(),
        ], 201);    }

    // Obtener una tarea específica por su ID
    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }
        return response()->json($task);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $tasks = Task::where('title', 'like', "%$searchQuery%")
                    ->orWhere('description', 'like', "%$searchQuery%")
                    ->orWhere('status', 'like', "%$searchQuery%")
                    ->orWhere('responsable', 'like', "%$searchQuery%")
                    ->orWhere('fechaLimite', 'like', "%$searchQuery%")
                    ->get();

        return response()->json($tasks);
    }

    public function storeCommentsAndDocuments(Request $request, $id)
    {
        $request->validate([
            'comment' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $task = Task::find($id);
        if ($task) {
            $task->comments()->create([
                'comment' => $request->input('comment'),
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName);
                $task->documents()->create([
                    'file_path' => $filePath,
                ]);
            }

            return response()->json(['message' => 'Comentario y documento guardados correctamente'], 200);
        }

        return response()->json(['error' => 'La tarea no se encontró'], 404);
    }



    // Actualizar una tarea existente
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'responsable' => 'required|string',
            'fechaLimite' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->responsable = $request->input('responsable');
        $task->fechaLimite = $request->input('fechaLimite');
        $task->save();

        return response()->json($task);
    }

    // Eliminar una tarea existente
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Tarea eliminada exitosamente']);
    }
}

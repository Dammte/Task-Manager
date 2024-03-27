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
            // Agrega otras reglas de validación según sea necesario
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'creation_date' => now(), // Opcional, puedes ajustar esto según tus necesidades
            'created_at' => now(),
            'updated_at' => now(),
            'status' => $request->input('status'),
            // Agrega otros campos según sea necesario
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

    // Actualizar una tarea existente
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            // Agrega otras reglas de validación según sea necesario
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
        // Actualiza otros campos según sea necesario
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

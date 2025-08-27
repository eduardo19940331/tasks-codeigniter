<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\ResponseInterface;

class TaskController extends BaseController
{
    protected $modelName = TaskModel::class;

    protected $rulesValidations = [
        'title' => 'required|min_length[3]|max_length[255]'
    ];

    /**
     * Obtiene todas el listado de las tareas en el sistema
     * 
     * returns them as a JSON response.
     * 
     * @return ResponseInterface respuesta formato JSON.
     */
    public function index(): ResponseInterface
    {
        $tasks = $this->model
            ->orderBy('completed', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON($tasks);
    }

    /**
     * obtiene la tarea segun el identificador que llegue por parametro
     * returns it as a JSON response, or a 404 error
     * 
     * @param id The `show` parametro id para devolver la tarea
     * 
     * @return ResponseInterface respuesta formato JSON.
     */
    public function show(?int $id = null): ResponseInterface
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->response->setStatusCode(404)->setJSON(['message' => "Tarea no encontrada"]);
        }

        return $this->response->setJSON($task);
    }

    /**
     * Registra las nuevas tareas
     * 
     * @param Request data de la nueva tarea
     * 
     * @return ResponseInterface respuesta formato JSON.
     */
    public function store(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        if (!$this->validate($this->rulesValidations)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $idTask = $this->model->insert($data, true);
        $task = $this->model->find($idTask);

        $response = [
            "task" => $task,
            "message" => "La tarea se creo correctamente!",
            "status" => "ok",
        ];

        return $this->response->setJSON($response);
    }

    /**
     * Actualizar la tarea
     * 
     * @param id The `update` identificador de la tarea especifica
     * @param Request data de la tarea a actualizar
     * 
     * @return a JSON response con la data actualizada de la tarea intervenida.
     */
    public function update(?int $id = null): ResponseInterface
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound(message: 'Tarea no encontrada');
        }

        $data = $this->request->getJSON(true);
        if (!$this->validate($this->rulesValidations)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);
        $task = $this->model->find($id);

        $response = [
            "task" => $task,
            "message" => "Tarea Actualizada correctamente",
            "status" => "ok",
        ];

        return $this->response->setJSON($response);
    }

    /**
     * Endpoint para el cambio de estado de las tareas
     * 
     * @param Request data de la tarea a alterar el estado
     * 
     * @return The JSON con la respuesta de la tarea y el mensage de lo realizado
     */
    public function action()
    {
        $data = $this->request->getJSON(true);

        $id = $data["id"] ?? null;
        $task = $this->model->find($id);
        if (empty($task)) {
            return $this->failNotFound(message: 'Tarea no encontrada');
        }
        $action = true;
        $messageAction = "marcada como Realizada";
        if ($task["completed"]) {
            $action = false;
            $messageAction = "marcada como Pendiente";
        }

        $this->model->update($id, ["completed" => $action]);
        $task = $this->model->find($id);

        $response = [
            "task" => $task,
            "message" => "Tarea $messageAction",
            "status" => "ok",
        ];

        return $this->response->setJSON($response);
    }

    /**
     * Endpoint elimina las tareas
     * 
     * @param id The `delete` identificador de la tarea a eliminar
     * 
     * @return id returns a JSON response identificador de la tarea eliminada.
     */
    public function delete(?int $id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound(message: 'Tarea no encontrada');
        }

        $this->model->delete($id);

        $response = [
            "id" => $id,
            "message" => "Tarea Eliminada correctamente",
            "status" => "ok",
        ];

        return $this->response->setJSON($response);
    }
}

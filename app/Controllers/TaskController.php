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

    public function index(): ResponseInterface
    {
        $tasks = $this->model->findAll();

        return $this->response->setJSON($tasks);
    }

    public function show(?int $id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->response->setStatusCode(404)->setJSON(['message' => "Tarea no encontrada"]);
        }

        return $this->response->setJSON($task);
    }

    public function store()
    {
        $data = $this->request->getJSON(true);

        # Aplica reglas de validacion
        if (!$this->validate($this->rulesValidations)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $task = $this->model->insert($data);

        return $this->response->setJSON($task);
        // return $this->respondCreated($task, 'Tarea Creada con exito!');
    }

    public function update(?int $id = null)
    {
        $task = $this->model->find($id);

        if (!$task) {
            return $this->failNotFound(message: 'Tarea no encontrada');
        }

        $data = $this->request->getJSON(true);

        if (!$this->validate($this->rulesValidations)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $task = $this->model->update($id, $data);

        return $this->respondUpdated($task, 'Se Actualizo la Tarea Correctamente');
    }

    public function delete(?int $id = null)
    {
        $task = $this->model->find($id);

        if (!$task) {
            return $this->failNotFound(message: 'Tarea no encontrada');
        }

        $this->model->delete($id);

        return $this->respondDeleted('Se elimino la tarea correctamente');
    }
}

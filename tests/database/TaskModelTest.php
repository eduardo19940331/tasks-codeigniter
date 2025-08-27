<?php

namespace Tests\database;

use App\Models\TaskModel;
use Tests\Support\DatabaseTestCase;

class TaskModelTest extends DatabaseTestCase
{
    protected TaskModel $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new TaskModel();
    }

    public function testValuesByDefaultOnInsert(): void
    {
        # En la data no declaramos el complete, que tiene valor por defecto en la BD = false
        $data = [
            'title' => 'Esta es una tarea de Prueba, para probar lo que se puede insertar en la base de datos',
        ];

        # Ingresamos el registro y almacenamos el id de la tarea
        $id = $this->model->insert($data);
        # Buscamos nuevamente en la BD
        $task = $this->model->find($id);

        # Esperamos que el campo sea falso
        $this->assertFalse($task['completed']);
        # Tambien validamos que el titulo insertado sea igual al de la data
        $this->assertEquals($data['title'], $task['title']);
    }

    public function testUpdateValue(): void
    {
        # data
        $data = ['title' => 'Este es un titulo de prueba'];
        # Insertamos
        $id = $this->model->insert($data);

        #cambiamos la Data
        $dataUpdate = ['title' => 'Titulo de prueba'];
        # Actualizamos
        $this->model->update($id, $dataUpdate);
        # Query
        $taskUpdate = $this->model->find($id);

        #test
        $this->assertEquals($dataUpdate['title'], $taskUpdate['title']);
    }
}

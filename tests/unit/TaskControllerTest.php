<?php

namespace Tests\Unit;

use App\Models\TaskModel;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\DatabaseTestCase;

class TaskControllerTest extends DatabaseTestCase
{
    use FeatureTestTrait;

    protected TaskModel $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new TaskModel();
    }

    public function testIndex(): void
    {
        # Llamamos al endpoint /tasks, lista
        $result = $this->call('get', '/tasks');

        #  Verificamos el status HTTP 200
        $result->assertStatus(200);

        # Decodificamos el JSON
        $data = json_decode($result->getJSON(true), true);
        # Debe ser un array (listado)
        $this->assertIsArray($data);
    }

    public function testStore(): void
    {
        # Data, tarea a ingresar
        $taskData = [
            'title' => 'Tarea de prueba'
        ];

        # Peticion
        $response = $this->withBody(json_encode($taskData))
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('/tasks');

        # response -> decodificamos el JSON
        $response->assertStatus(200);
        $result = json_decode($response->getJSON(true), true);

        # verificamos que se cumpla
        $this->assertArrayHasKey('task', $result);
        $this->assertEquals($taskData['title'], $result['task']['title']);
    }

    public function testChangeState(): void
    {
        # Intervencion directa en la BD para luego actualizar el campo complete
        $db = \Config\Database::connect();
        $db->transStart();
        $taskData = [
            'title' => 'Tarea de prueba'
        ];
        # Inseretamos un registro en la BD
        $idTask = $this->model->insert($taskData, true);
        $db->transComplete();

        # Cambiamos el estado de la misma tarea creada
        $data = ["id" => $idTask];
        $responseAfter = $this->withBody(json_encode($data))
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('/tasks/action');
        # Validamos request ok
        $responseAfter->assertStatus(200);

        # La data debe venir completed = true, ya que se realizo la peticion al endpoint actions
        # como se carga por defecto en false, con el cambio verificamos que este en true
        $resultAfter = json_decode($responseAfter->getJSON(true), true);
        $taskAfterState = $resultAfter["task"]["completed"];

        $this->assertTrue($taskAfterState);
    }
}

<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use Config\Migrations;

class DatabaseTestCase extends CIUnitTestCase
{
    /**
     * Habilitar migraciones automáticas antes de cada test
     */
    protected $migrate = true;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->migrate) {
            // Ejecutar migraciones en la base de datos de testing
            $migrations = new Migrations();
            $runner = service('migrations');

            // Asegurarse de apuntar a la conexión 'testing'
            $runner->setNamespace(null); // todas las migraciones
            $runner->latest();           // ejecuta todas las migraciones pendientes
        }
    }
}

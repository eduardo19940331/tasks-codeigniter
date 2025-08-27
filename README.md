# TodoList - CodeIgniter 4 + Docker

Proyecto de ejemplo de una aplicación de tareas usando **CodeIgniter 4**, **PostgreSQL**, **Nginx**, **Docker** y **DataTables**.

---

## Requisitos

Para un correcto funcionamiento debe tener las siguientes herramientas en las versiones detalladas

- [Docker](https://www.docker.com/get-started) >= 24
- [Docker Compose](https://docs.docker.com/compose/install/) >= 2.17
- Navegador moderno
- (Opcional) [Composer](https://getcomposer.org/) para instalar dependencias locales

---

## Instalación

Desde Linux preferentemente en el directorio /opt creamos /projects
```bash
mkdir /opt/projects
cd /opt/projects
```

1. **Clonar el repositorio**
```bash
git clone https://github.com/eduardo19940331/tasks-codeigniter.git TodoList
```
y nos movemos dentro del proyecto
```bash
cd todolist
```

2. **Copiar y pegar .env.example**
```bash
mv .env.example .env
```

3. **Construimos las imagenes y contenedores**
```bash
docker-compose build
```

4. **Levantamos los contenedores**
```bash
docker-compose up -d
```

5. **Verificar el estado de los contenedores**
```bash
docker-compose ps
```
Deberías ver codeigniter_app, codeigniter_nginx y codeigniter_db corriendo

Tambien podemos revisar
http://localhost:8080/
no te alarmes si aun no ves la app, continuemos...

6. **Base de Datos**
Base de datos: PostgresSql, la configuración por defecto se encuentra en app/Config/Database.php en el compartimiento que los creadores de codeigniter dejaron exclusivamente para PostgresSQL y usa:
```bash
Host: 'db', # -> localhost para conectarse desde fuera
Username: 'ciuser',
Password: 'secret',
Database: 'todolist',
```
Si necesita mas detalle de la configuracion, revisar el archivo antes mencionado.

Ahora deebemos recrear la carpeta vendor y los archivos composer, para eso ejecutamos

```bash
docker exec -it codeigniter_app composer install
```

(Si algo sale mal, revisa tus versiones de php y composer, en algunos casos causa conflictos)

7. **Migraciones**
Una vez con los contenedores funcionando y composer instalado ejecutamos las migraciones
Para crear la BD y la tabla de tareas, ejecute:
```bash
docker exec -it codeigniter_app php spark migrate
```
Esto instancia el contenedor de php y ejecuta el comando para ejecutar la migracion

8. **Endpoints**
La aplicacion consta de los siguientes endpoint

- GET /tasks: Obtiene y retorna una lista de todas las tareas en formato JSON.
- GET /tasks/{id}: Obtiene y retorna una tarea específica por su ID en formato JSON.
- POST /tasks: Crea una nueva tarea.
- PUT /tasks/{id}: Actualiza una tarea existente.
- DELETE /tasks/{id}: Elimina una tarea por su ID
- POST /tasks/action: Cambia el estado de una tarea.

(este ultimo enpoint me atrevi a realizarlo para que la tabla tambien tuviera un poco de dinamismo en esa columna)

9. **Test**
Para ejecutar los test se hace con el siguiente comando.
```bash
docker exec -it codeigniter_app vendor/bin/phpunit
```
Los test tienen codigo que ejecutan las migraciones a los contenedores respectivos y crean este ambiente de pruebas

Si se presentan inconvenientes con gusto te ayudo!!
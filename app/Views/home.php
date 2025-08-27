<?= $this->extend('layout/default') ?>

<?= $this->section('menu') ?>
<ul>
    <li><a href="#home">TAREAS</a></li>
    <li><a href="#about">AGREGAR TAREA</a></li>
</ul>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Tareas</h1>
        </div>
        <div class="col-sm-6 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary btnNewTask"><i class="bi bi-card-checklist"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <table id="task-table" class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Editar tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form id="taskForm">
                    <input type="hidden" id="taskId">

                    <div class="mb-3">
                        <label for="taskDate" class="form-label">Fecha</label>
                        <input type="text" class="form-control" id="taskDate" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Título</label>
                        <textarea type="text" class="form-control" id="taskTitle" required></textarea>
                    </div>

                    <div class="form-check">
                        <div id="alert-success-state" class="alert alert-success" role="alert">
                            <i class="bi bi-clipboard-check-fill"></i> Realizada
                        </div>
                        <div id="alert-danger-state" class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> Pendiente
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modalTask">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveTaskBtn"><i class="bi bi-floppy"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteTaskModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteTaskId">
                <p>¿Realmente desea eliminar la tarea?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Si, Eliminar</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('js/home/tasks.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Tareas</h1>
        </div>
        <div class="col-sm-6 d-md-flex justify-content-md-end">
            <button type="button" id="btnNewTask" class="btn btn-primary btn-sm m-2"><i class="bi bi-card-checklist"></i> Nueva Tarea</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <table id="task-table" class="table table-bordered border-bottom">
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
<div class="modal" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Tarea</h5>
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
                        <textarea type="text" class="form-control" style="resize: none" id="taskTitle" maxlength="255" minlength="3" rows="5" required></textarea>
                    </div>

                    <div class="form-check" style="padding-left: 0 !important;">
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
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteTaskId">
                <p>¿Realmente desea eliminar la tarea?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnDeleteTask" class="btn btn-primary">Si, Eliminar</button>
            </div>
        </div>
    </div>
</div>


<div id="actionTaskModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="actionTaskId">
                <p>¿Desea Marcar esta tarea como
                    <label id="labelAction">Realizada</label>?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnActionTask" class="btn btn-primary">Si, Hacer</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="module" src="<?= base_url('js/home/tasks.js') ?>"></script>
<?= $this->endSection() ?>
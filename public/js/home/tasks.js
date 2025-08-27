import { actionLoadTasks, actionCreateTask, actionUpdateTask, actionActionTask, actionDeleteTask, actionShowTask } from './api.js';

let table;
const taskModal = new bootstrap.Modal(document.getElementById('taskModal'));
const deleteTaskModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'));
const actionTaskModal = new bootstrap.Modal(document.getElementById('actionTaskModal'));

document.addEventListener("DOMContentLoaded", () => {
    initialLoad();
    table = document.querySelector("#task-table");
});

document.querySelector('#task-table tbody').addEventListener('click', (event) => {
    if (event.target.classList.contains('btn-edit')) {
        const id = event.target.dataset.id;
        launchEditTask(id);
    }

    if (event.target.classList.contains('btn-delete')) {
        const id = event.target.dataset.id;
        launchDeleteTask(id);
    }

    if (event.target.classList.contains('btn-action')) {
        const id = event.target.dataset.id;
        const action = event.target.dataset.action;
        let labelMessage = "Realizada";
        if (action == "true") {
            labelMessage = "Pendiente";
        }
        document.getElementById('labelAction').textContent = labelMessage;
        launchActionTask(id);
    }
});

document.querySelector('#btnDeleteTask').addEventListener("click", async (event) => {
    const idTask = document.getElementById("deleteTaskId").value;
    await actionDeleteTask(idTask);
    initialLoad();
    deleteTaskModal.hide();
});

document.querySelector('#btnActionTask').addEventListener("click", async (event) => {
    const idTask = document.getElementById("actionTaskId").value;
    await actionActionTask(idTask);
    initialLoad();
    actionTaskModal.hide();
});

document.querySelector('#btnNewTask').addEventListener("click", (event) => {
    launchCreateTask();
});

document.querySelector('#saveTaskBtn').addEventListener("click", async () => {
    const id = document.getElementById("taskId").value;
    const title = document.getElementById("taskTitle").value;

    if (id) {
        await actionUpdateTask({ id, title });
    } else {
        await actionCreateTask({ title });
    }
    initialLoad();
    taskModal.hide();
});

const initialLoad = async () => {
    const taskList = document.querySelector("#task-table tbody");


    try {
        const result = await actionLoadTasks();

        if ($.fn.DataTable.isDataTable('#task-table')) {
            table.destroy();
        }
        taskList.innerHTML = "";

        result.forEach((task, index) => {
            index++;
            const btnIconAction = task.completed ? 'check-square' : 'square';
            const subTitle = task.title.length > 80 ? `${task.title.substring(0, 80)} ...` : task.title;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                        <td>${index}</td>
                        <td data-toggle="tooltip" data-placement="left" title="${task.title}">${subTitle}</td>
                        <td>${(task.completed) ? 'Realizada' : 'Pendiente'}</td>
                        <td class="d-md-flex d-md-table-cell justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm btn-edit me-2" data-id="${task.id}">Editar</button>
                            <button type="button" class="btn btn-secondary btn-sm btn-delete me-2" data-id="${task.id}">Eliminar</button>
                            <button type="button" class="btn btn-outline-primary btn-sm btn-action" data-action="${task.completed}" data-id="${task.id}">
                                <i data-id="${task.id}" data-action="${task.completed}" class="bi bi-${btnIconAction} btn-action"></i>
                            </button>
                        </td>`;
            taskList.appendChild(tr);
        });
        relaunchDataTable();

    } catch (error) {
        console.error("Error al listar las tareas: " + error.message);
        toastr.error("!Ups, algo salio mal al Cargar la tabla");
    }
};

const launchCreateTask = () => {
    reloadForm();
    document.getElementById('alert-danger-state').style.display = 'none';
    document.getElementById('alert-success-state').style.display = 'none';
    const date = getFormattedDate();
    document.getElementById('taskDate').value = date;
    taskModal.show();
}

const launchEditTask = async (id) => {
    const result = await actionShowTask(id);

    reloadForm();
    document.getElementById('taskId').value = result.id;
    document.getElementById('taskDate').value = result.created_at;
    document.getElementById('taskTitle').value = result.title;
    const alertStateHide = result.completed ? 'alert-danger-state' : 'alert-success-state';
    document.getElementById(alertStateHide).style.display = 'none';

    taskModal.show();
};

const launchActionTask = (id) => {
    document.getElementById('actionTaskId').value = id;
    actionTaskModal.show();
}

const launchDeleteTask = (id) => {
    document.getElementById('deleteTaskId').value = id;
    deleteTaskModal.show();
};

const reloadForm = () => {
    document.getElementById('taskId').value = "";
    document.getElementById('taskDate').value = "";
    document.getElementById('taskTitle').value = "";
    document.getElementById('alert-danger-state').style.display = '';
    document.getElementById('alert-success-state').style.display = '';
}

const relaunchDataTable = () => {
    if ($.fn.DataTable.isDataTable('#task-table')) {
        table.destroy();
    }

    table = new DataTable('#task-table', {
        responsive: true,
        pageLength: 10,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });
};

const getFormattedDate = () => {
    const now = new Date();

    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0'); // meses empiezan en 0
    const year = now.getFullYear();

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
}
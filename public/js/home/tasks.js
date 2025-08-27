let table;
const taskModal = new bootstrap.Modal(document.getElementById('taskModal'));
const deleteTaskModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'));

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
});

document.querySelector('#saveTaskBtn').addEventListener("click", async () => {
    const id = document.getElementById
});

const initialLoad = async () => {
    const table = document.querySelector("#task-table");

    const taskList = document.querySelector("#task-table tbody");

    fetch("http://localhost:8080/tasks")
        .then(resp => resp.json())
        .then(result => {
            try {
                taskList.innerHTML = "";

                result.forEach((task, index) => {
                    index++;

                    const btnIconAction = task.completed ? 'check-square' : 'square';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index}</td>
                        <td>${task.title}</td>
                        <td>${(task.completed) ? 'Realizada' : 'Pendiente'}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="${task.id}">Editar</button>
                            <button type="button" class="btn btn-secondary btn-sm btn-delete" data-id="${task.id}">Eliminar</button>
                            <button type="button" class="btn btn-outline-primary btn-sm btn-action" data-id="${task.id}"><i class="bi bi-${btnIconAction}"></i></button>
                        </td>`;

                    taskList.appendChild(tr);
                });

                relaunchDataTable();

            } catch (error) {
                console.error("Error al crear tarea: " + error.message);
                taskList.innerHTML(`<tr>
                    <td colspan="4">Error cargando tareas</td>
                    </tr>`);
            }
        })
        .catch(error => console.log(error.message));
};

const launchEditTask = (id) => {
    fetch(`http://localhost:8080/tasks/${id}`)
        .then(resp => resp.json())
        .then(result => {
            reloadForm();
            document.getElementById('taskId').value = result.id;
            document.getElementById('taskDate').value = result.created_at;
            document.getElementById('taskTitle').value = result.title;
            const alertStateHide = result.completed ? 'alert-danger-state' : 'alert-success-state';
            document.getElementById(alertStateHide).style.display = 'none';

            taskModal.show();
        })
        .catch();
};

const launchDeleteTask = (id) => {
    document.getElementById('deleteTaskId').value = id;
    deleteTaskModal.show();
};

const constDeleteTask = (id) => {
    fetch(`http://localhost:8080/tasks/${id}`, {
        method: 'DELETE',
    })
        .then(resp => resp.json())
        .then(result => {
            console.log(result);
            initialLoad();
        })
        .catch(error => console.log(error.message));
}

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
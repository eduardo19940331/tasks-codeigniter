
const URI = `http://localhost:8080/`;

export const actionLoadTasks = async () => {
    return await fetch(URI + "tasks")
        .then(resp => resp.json())
        .then(result => {
            return result;
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal al Cargar la tabla");
            console.error(error.message);
        });
}

export const actionShowTask = async (id) => {
    return await fetch(URI + `tasks/${id}`)
        .then(resp => resp.json())
        .then(result => {
            return result;
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal al mostrar la tarea");
            console.error(error.message);
        });
}

export const actionCreateTask = async (task) => {
    await fetch(URI + "tasks", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(task),
    })
        .then(resp => resp.json())
        .then(result => {
            const { message } = result;
            toastr.success(message);
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal en la Creacion");
            console.error(error.message);
        });
    return;
}

export const actionUpdateTask = async ({ id, title }) => {
    await fetch(URI + `tasks/${id}`, {
        method: 'PUT',
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ title })
    })
        .then(resp => resp.json())
        .then(result => {
            const { message } = result;
            toastr.success(message);
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal en la Actualiacion");
            console.error(error.message);
        });
    return;
}

export const actionDeleteTask = async (id) => {
    await fetch(URI + `tasks/${id}`, {
        method: 'DELETE',
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then(resp => resp.json())
        .then(result => {
            const message = result.message;
            toastr.success(message);
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal al Eliminar una tarea");
            console.error(error.message);
        });
    return;
}

export const actionActionTask = async (id) => {
    await fetch(URI + `tasks/action`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id }),
    })
        .then(resp => resp.json())
        .then(result => {
            const message = result.message;
            toastr.success(message);
        })
        .catch(error => {
            toastr.error("!Ups, algo salio mal al cambiar el Estado");
            console.error(error.message);
        });
    return;
}
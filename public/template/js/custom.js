showCategories();

const addModalElement = document.querySelector("#addModal");
const addAlertElement = document.querySelector("#add-alert");

addModalElement.addEventListener("submit", async function (e) {
    e.preventDefault();

    const addNameElement = document.querySelector("#add-name");

    let addNameValue = addNameElement.value;

    if (addNameValue == "" || addNameValue === undefined) {
        addNameElement.classList.add('is-invalid');
        addAlertElement.innerHTML = alert("Provide category name!");
    } else {
        addNameElement.classList.remove('is-invalid');
        addAlertElement.innerHTML = "";

        const data = {
            name: addNameValue,
            id: ID
        };

        const response = await fetch(addRoute, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
            },
        });

        const result = await response.json();

        if (result.name) {
            addNameElement.classList.add('is-invalid');
            addAlertElement.innerHTML = alert(result.name);
        } else if (result.success) {
            addAlertElement.innerHTML = alert(result.success, 'success');
            addNameElement.value = "";
            showCategories();
        } else if (result.failure) {
            addAlertElement.innerHTML = alert(result.failure);
        } else {
            addAlertElement.innerHTML = alert();
        }
    }
});

async function showCategories() {
    const responseElement = document.querySelector("#response");

    const response = await fetch(showAllRoute);
    const result = await response.json();

    if (result.categories.length !== 0) {
        let rows = '';

        result.categories.forEach(function (category, index) {
            rows += `<tr>
                                            <td>${index + 1}</td>
                                            <td>${category.name}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="editCategory(${category.id})"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" onclick="deleteCategory(${category.id})"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>`;
        });
        responseElement.innerHTML = `<table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    ${rows}
                                    </tbody>
                                </table>`;
    } else {
        responseElement.innerHTML = `<div class="alert alert-info m-0">No record found</div>`;
    }
}

const editNameElement = document.querySelector("#edit-name");

let mainId = null;
async function editCategory(id) {
    mainId = id;
    clearEditModal();
    const APIURL = showSingleRoute.replace(':id', id);
    const response = await fetch(APIURL);
    const result = await response.json();

    editNameElement.value = result.category.name;
}

const editModalElement = document.querySelector("#editModal");
const editAlertElement = document.querySelector("#edit-alert");

editModalElement.addEventListener('submit', async function (e) {
    e.preventDefault();

    let editNameValue = editNameElement.value;

    if (editNameValue == "" || editNameValue === undefined) {
        editNameElement.classList.add('is-invalid');
        editAlertElement.innerHTML = alert("Provide category name!");
    } else {
        editNameElement.classList.remove('is-invalid');
        editAlertElement.innerHTML = "";

        const data = {
            name: editNameValue,
            id: mainId
        };

        const APIURL = updateRoute.replace(':id', mainId);

        const response = await fetch(APIURL, {
            method: 'PATCH',
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
            },
        });

        const result = await response.json();

        if (result.name) {
            editNameElement.classList.add('is-invalid');
            editAlertElement.innerHTML = alert(result.name);
        } else if (result.success) {
            editAlertElement.innerHTML = alert(result.success, 'success');
            showCategories();
        } else if (result.failure) {
            editAlertElement.innerHTML = alert(result.failure);
        } else {
            editAlertElement.innerHTML = alert();
        }
    }
});

function deleteCategory(id) {
    mainId = id;
}

const deleteModalElement = document.querySelector("#deleteModal");
const alertElement = document.querySelector("#alert");

deleteModalElement.addEventListener('submit', async function (e) {
    e.preventDefault();

    const data = {
        id: mainId
    };

    const APIURL = destroyRoute.replace(':id', mainId);

    const response = await fetch(APIURL, {
        method: 'DELETE',
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
        },
    });

    const result = await response.json();

    if (result.success) {
        alertElement.innerHTML = alert(result.success, 'success');
        showCategories();
    } else if (result.failure) {
        alertElement.innerHTML = alert(result.failure);
    } else {
        alertElement.innerHTML = alert();
    }
    closeDeleteModal();
});

function alert(msg = "Something went wrong!", cls = "danger") {
    return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
    ${msg}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}

function clearAddModal() {
    addAlertElement.innerHTML = "";
    const addNameElement = document.querySelector("#add-name");
    addNameElement.classList.remove("is-invalid");
}

function clearEditModal() {
    editAlertElement.innerHTML = "";
    const editNameElement = document.querySelector("#edit-name");
    editNameElement.classList.remove("is-invalid");
}

function closeDeleteModal() {
    const modalElement = document.querySelector('#deleteModal');
    const modal = bootstrap.Modal.getInstance(modalElement);

    if (modal) {
        modal.hide();
    }
}

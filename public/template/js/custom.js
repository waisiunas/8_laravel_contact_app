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
        } else if (result.failure) {
            addAlertElement.innerHTML = alert(result.failure);
        } else {
            addAlertElement.innerHTML = alert();
        }
    }
});

function alert(msg = "Something went wrong!", cls = "danger") {
    return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
    ${msg}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}

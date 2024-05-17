async function getAllUsersDataTable(){
    loadAnimation("body", true);
    const data = { op: "getAllUsersDataTable"};
    const url = "controllers/users.controller.php";
    try{

        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        loadAnimation("body", false);
        if(response.ok){
            const result = await response.json();
            document.getElementById("response-all-users-data-table").innerHTML = result;
            return result;
        }else{ message("Error HTTP: " + response.status, "error"); }
        
    }catch(error){
        message("Error de conexión: " + error.message, "error");
    }
}

function toggleEditUserCredits(originButton){
    document.getElementById("edit-user-credits").value = originButton.getAttribute("data-user-credits");
    document.getElementById("button-confirm-edit-user-credits").setAttribute("data-user-id", originButton.getAttribute("data-user-id"));
    toggleWindow("#window-edit-user-credits","absolute");
}
async function editUserCredits(originButton){
    const parent = "#window-edit-user-credits";
    loadAnimation(parent, true);
    toggleButton(parent, true);
    
    const data = {
        op: "modifyUserCredits",
        user_id: originButton.getAttribute("data-user-id"),
        user_credits: document.getElementById("edit-user-credits").value
    };
    const url = "controllers/users.controller.php";
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        loadAnimation(parent, false);
        toggleButton(parent, false);
        if(response.ok){
            const result = await response.json();
            if(!result){
                message("Error al editar los créditos del usuario", "error");
                return;
            }
            message("Créditos editados correctamente", "success");
            toggleWindow();
            getAllUsersDataTable();

        }else{ message("Error HTTP: " + response.status, "error"); }
    }catch(error){
        message("Error de conexión: " + error.message, "error");
    }
}

function toggleEditUserPermissions(originButton){
    toggleWindow("#window-edit-user-permissions","absolute");
    document.getElementById("button-confirm-edit-user-permissions").setAttribute("data-user-id", originButton.getAttribute("data-user-id"));
    const select = document.getElementById("edit-user-permissions");
    select.value = originButton.getAttribute("data-user-permissions");
}
async function editUserPermissions(originButton){
    const parent = "#window-edit-user-permissions";
    loadAnimation(parent, true);
    toggleButton(parent, true);
    
    const data = {
        op: "modifyUserPermissions",
        user_id: originButton.getAttribute("data-user-id"),
        user_permissions: document.getElementById("edit-user-permissions").value
    };
    const url = "controllers/users.controller.php";
    try{
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        loadAnimation(parent, false);
        toggleButton(parent, false);
        if(response.ok){
            const result = await response.json();
            if(!result){
                message("Error al editar los permisos del usuario", "error");
                return;
            }
            message("Permisos editados correctamente", "success");
            toggleWindow();
            getAllUsersDataTable();

        }else{ message("Error HTTP: " + response.status, "error"); }
    }catch(error){
        message("Error de conexión: " + error.message, "error");
    }

}
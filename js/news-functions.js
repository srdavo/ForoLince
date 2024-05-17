async function createNew(){
    const parent = "#window-create_news";
    if(!checkEmpty(parent, "input, textarea")){
        return false;
    }
    toggleButton(parent, true);
    loadAnimation(parent, true);

    const data = {
        op: "createNew",
        new_title: document.getElementById("create-new_title").value,
        new_content: document.getElementById("create-new_content").value,
        new_image: document.getElementById("create-new_image").value,        
    };
    const url = "controllers/news.controller.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parent, false);
        loadAnimation(parent, false);
    
        if (response.ok) {
            const result = await response.json();
            if (!result) {
                message("Error de respuesta", "error");
                return false;
            }
            // Success actions
            toggleWindow();
            message("Noticia creada correctamente", "success");
            displayNewsTable();
            return true;
    
        } else {
            message("Error HTTP: " + response.status, "error");
        }
        } catch (error) {
            message("Error de conexión: " + error.message, "error");
        }
        return false;
    
}
async function editNew(originButton){
    const parent = "#window-edit_news";
    if(!checkEmpty(parent, "input, textarea")){
        return false;
    }
    toggleButton(parent, true);
    loadAnimation(parent, true);

    const data = {
        op: "editNew",
        new_id: originButton.getAttribute("data-new-id"),
        new_title: document.getElementById("edit-new_title").value,
        new_content: document.getElementById("edit-new_content").value,
        new_image: document.getElementById("edit-new_image").value,        
    };
    const url = "controllers/news.controller.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parent, false);
        loadAnimation(parent, false);
    
        if (response.ok) {
            const result = await response.json();
            if (!result) {
                message("Error de respuesta", "error");
                return false;
            }
            // Success actions
            toggleWindow();
            message("Noticia editada correctamente", "success");
            displayNewsTable();
            return true;
    
        } else {
            message("Error HTTP: " + response.status, "error");
        }
        } catch (error) {
            message("Error de conexión: " + error.message, "error");
        }
        return false;
    

}
async function deleteNew(originButton){
    const parent = "#window-delete_new_confirmation";
    toggleButton(parent, true);
    loadAnimation(parent, true);

    const data = {
        op: "deleteNew",
        new_id: originButton.getAttribute("data-new-id"),
    };
    const url = "controllers/news.controller.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        toggleButton(parent, false);
        loadAnimation(parent, false);
    
        if (response.ok) {
            const result = await response.json();
            if (!result) {
                message("Error de respuesta", "error");
                return false;
            }
            // Success actions
            toggleWindow();
            message("Noticia eliminada correctamente", "success");
            displayNewsTable();
            return true;
    
        } else {
            message("Error HTTP: " + response.status, "error");
        }
        } catch (error) {
            message("Error de conexión: " + error.message, "error");
        }
        return false;
}

async function getNewsTable(page, viewType){
    if (page === undefined) {page = 0;}
    if(viewType === undefined) {viewType = "0";}
    loadAnimation("body", true);
    const data = { op: "getNewsTable", page:page, view_type: viewType};
    const url = "controllers/news.controller.php";
    try{

        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        loadAnimation("body", false);
        if(response.ok){
            const result = await response.json();
            return result;
        }else{ message("Error HTTP: " + response.status, "error"); }
        
    }catch(error){
        message("Error de conexión: " + error.message, "error");
    }
}

async function displayNewsTable(page, viewType){
    newsTable = await getNewsTable(page, viewType);
    document.getElementById("response-user-news_table").innerHTML = newsTable;
}
async function displayAdminNewsTable(page, viewType){
    newsTable = await getNewsTable(page, viewType);
    document.getElementById("response-admin-news-table").innerHTML = newsTable;
}

function getNewRowData(originButton) {
    const rowData = originButton.closest("tr");
    return {
        newId: rowData.getAttribute("data-new-id"),
        newTitle: rowData.getAttribute("data-new-title"),
        newContent: rowData.getAttribute("data-new-content"),
        newImage: rowData.getAttribute("data-new-image"),
    };
}

function toggleEditNew(originButton){
    toggleWindow("#window-edit_news");
    data = getNewRowData(originButton);
    // document.getElementById("edit-new_id").value = data.newId;
    document.getElementById("edit-new_title").value = data.newTitle;
    document.getElementById("edit-new_content").value = data.newContent;
    document.getElementById("edit-new_image").value = data.newImage;
    document.getElementById("button-confirm-edit-new").setAttribute("data-new-id", data.newId);
}
function toggleDeleteNew(originButton){
    toggleWindow("#window-delete_new_confirmation", "absolute");
    data = getRowData(originButton);
    document.getElementById("button-confirm-delete-new").setAttribute("data-new-id", data.newId);
}

async function getNewsCards(){
    
    const data = { op: "getNewsCards"};
    const url = "controllers/news.controller.php";
    try{

        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if(response.ok){
            const result = await response.json();
            document.getElementById("response-news_holder").innerHTML = result;
            return result;
        }else{ message("Error HTTP: " + response.status, "error"); }
        
    }catch(error){
        message("Error de conexión: " + error.message, "error");
    }
}


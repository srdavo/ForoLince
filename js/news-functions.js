async function createNewNew(){
    const parent = "window-create_new";
    if(!checkEmpty(parent, "input, textarea")){
        return false;
    }
    toggleButton(parent, true);
    loadAnimation(parent, true);

    const data = {
        op: "createNewNew",
        new_title: document.getElementById("create-new_title"),
        new_description: document.getElementById("create-new_description"),
        new_image: document.getElementById("create-new_image"),        
    };
    const url = "controllers/news.controller.php";
    const response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
    });
    if(response.ok){
        const result = await response.json();
        toggleButton(parent, false);
        loadAnimation(parent, false);

        if (!result){
            message ("hubo un error","error");
            return false;
            
        }

        message ("noticia creada","success");
        toggleWindow();
        getNewsT
    }
    
}
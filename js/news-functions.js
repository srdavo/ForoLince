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
    const response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
    });
    if(response.ok){
        const result = await response.json();
        toggleButton(parent, false);
        loadAnimation(parent, false);

        // if (!result){
        //     message ("hubo un error","error");
        //     return false;
        // }

        message ("noticia creada","success");
        toggleWindow();
    }
    
}
async function createNewEvent(){
    const parent = "#window-create_event"
    if(!checkEmpty('#window-create_event', 'input')){ return false;}
    toggleButton(parent, true);
    loadAnimation(parent, true);

    const eventName = document.getElementById("create-event_name");
    const eventDescription = document.getElementById("create-event_description");
    const eventDate = document.getElementById("create-event_date");
    const eventAddress = document.getElementById("create-event_address");
    const eventImage = document.getElementById("create-event_image");

    const data = {
        op: "createNewEvent",
        event_name: eventName.value,
        event_description: eventDescription.value,
        event_date: eventDate.value,
        event_address: eventAddress.value,
        event_image: eventImage.value
    };
    const url = 'controllers/events.controller.php';
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
    });
    if (response.ok) {
        const result = await response.json();
        toggleButton(parent, false);
        loadAnimation(parent, false);

        if(!result){
            message("Hubo un error", "error");
            return false;
        }
         
        message("Movimiento agregado", "success");4
        toggleWindow();
        return true;
    }
}

async function getEvents(){
    const data = {
        op: "getEvents",
    };
    const url = 'controllers/events.controller.php';
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
    });
    if (response.ok) {
        const result = await response.json();
        if (!result) {
            message("Hubo un error", "error");
            return false;
        }

        document.getElementById("response-events_holder").innerHTML = result;
        return true;


    }
}
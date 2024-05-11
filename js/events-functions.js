async function createNewEvent() {
  const parent = "#window-create_event";
  if (!checkEmpty("#window-create_event", "input, textarea")) {
    return false;
  }
  toggleButton(parent, true);
  loadAnimation(parent, true);

  const eventName = document.getElementById("create-event_name");
  const eventDescription = document.getElementById("create-event_description");
  const eventDate = document.getElementById("create-event_date");
  const eventTime = document.getElementById("create-event_time");
  const eventAddress = document.getElementById("create-event_address");
  const eventImage = document.getElementById("create-event_image");
  const eventCredits = document.getElementById("create-event_credits");

  const data = {
    op: "createNewEvent",
    event_name: eventName.value,
    event_description: eventDescription.value,
    event_date: eventDate.value,
    event_time: eventTime.value,
    event_address: eventAddress.value,
    event_image: eventImage.value,
    event_credits: eventCredits.value,
  };
  const url = "controllers/events.controller.php";
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    toggleButton(parent, false);
    loadAnimation(parent, false);

    if (!result) {
      message("Hubo un error", "error");
      return false;
    }

    message("Evento creado", "success");
    toggleWindow();
    getEventsTable();
    return true;
  }
}

async function getEventsCards() {
  const data = {
    op: "getEvents",
  };
  const url = "controllers/events.controller.php";
  const response = await fetch(url, {
    method: "POST",
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

async function getEventsTable() {
  const data = {
    op: "getEventsTable",
  };
  const url = "controllers/events.controller.php";
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    if (!result) {
      message("Hubo un error", "error");
      return false;
    }

    document.getElementById("response-events_table").innerHTML = result;
    return true;
  }
}

function getRowData(originButton) {
  const rowData = originButton.closest("tr");
  return {
    eventId: rowData.getAttribute("data-event-id"),
    eventImg: rowData.getAttribute("data-event-img"),
    eventName: rowData.getAttribute("data-event-name"),
    eventDescription: rowData.getAttribute("data-event-description"),
    eventDate: rowData.getAttribute("data-event-date"),
    eventTime: rowData.getAttribute("data-event-time"),
    eventAddress: rowData.getAttribute("data-event-address"),
    eventCredits: rowData.getAttribute("data-event-credits"),
  };
}
function getEditEventInputsData() {
  return {
    eventName: document.getElementById("edit-event_name").value,
    eventDescription: document.getElementById("edit-event_description").value,
    eventDate: document.getElementById("edit-event_date").value,
    eventTime: document.getElementById("edit-event_time").value,
    eventAddress: document.getElementById("edit-event_address").value,
    eventImage: document.getElementById("edit-event_image").value,
    eventCredits: document.getElementById("edit-event_credits").value,
  };
}

function setEditEventData(rowData) {
  // Los valores del registro se asignan a los inputs para editar
  document.getElementById("edit-event_name").value = rowData.eventName;
  document.getElementById("edit-event_description").value = rowData.eventDescription;
  document.getElementById("edit-event_credits").value = rowData.eventCredits;
  document.getElementById("edit-event_date").value = rowData.eventDate;
  document.getElementById("edit-event_time").value = rowData.eventTime;
  document.getElementById("edit-event_address").value = rowData.eventAddress;
  document.getElementById("edit-event_image").value = rowData.eventImg;
}
function openEditEventWindow(originButton) {
  const rowData = getRowData(originButton);
  document.getElementById("button-edit-event").setAttribute("data-event-id", rowData.eventId);
  setEditEventData(rowData);
  toggleWindow("#window-edit_event");
}

async function editEvent(originButton) {
  const parent = "#window-edit_event";
  if (!checkEmpty(parent, "input, textarea")) {
    return;
  }
  toggleButton(parent, true);
  loadAnimation(parent, true);

  const eventId = originButton.getAttribute("data-event-id");
  const eventEditedData = JSON.parse(JSON.stringify(getEditEventInputsData()));
  
  const data = {
    op: "editEvent",
    event_id: eventId,
    event_name: eventEditedData.eventName,
    event_description: eventEditedData.eventDescription,
    event_credits: eventEditedData.eventCredits,
    event_date: eventEditedData.eventDate,
    event_time: eventEditedData.eventTime,
    event_address: eventEditedData.eventAddress,
    event_image: eventEditedData.eventImage,
  };
  const url = "controllers/events.controller.php";
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
  });
  if (response.ok) {
    const result = await response.json();
    loadAnimation(parent, false);

    if (!result) {
      message("Hubo un error", "error");
      return false;
    }

    toggleButton(parent, false);
    message("Evento editado ", "success");
    getEventsTable();
    toggleWindow();
  } else {
    toggleButton(parent, false);
    loadAnimation(parent, false);
    message("Hubo un error", "error");
  }
}

function deleteEvent(originButton) {
  if(originButton.getAttribute("ask-confirmation") == "true"){
    toggleWindow('#window-delete_event_confirmation','absolute')
    document.getElementById("button-confirm-delete-event").setAttribute("data-event-id", originButton.getAttribute("data-event-id"));
  }
  if(originButton.hasAttribute("confirm-delete")){
    const eventId = originButton.getAttribute("data-event-id");
    const data = {
      op: "deleteEvent",
      event_id: eventId,
    };
    const url = "controllers/events.controller.php";
    fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((result) => {
        if (!result) {
          message("Hubo un error", "error");
          return false;
        }
        toggleWindow();
        message("Evento eliminado", "success");
        getEventsTable();
      });
  }
}


function getEventCardData(originButton){

  // const eventId = originButton.getAttribute("data-event-id");
  const eventName = originButton.getAttribute("data-event-name");
  console.log(eventName);

  // console.log(eventId);
}
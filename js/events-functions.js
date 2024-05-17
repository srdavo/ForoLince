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
    date_filter: document.getElementById("filter-events-date-filter").value,
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
  try {
    const eventId = originButton.getAttribute("data-event-id");
    const eventName = originButton.getAttribute("data-event-name");
    const eventCredits = originButton.getAttribute("data-event-credits");
    const eventDate = originButton.getAttribute("data-event-date");
    const eventTime = originButton.getAttribute("data-event-time");
    
    document.getElementById("modify-inscription-event-name").textContent = eventName;
    document.getElementById("modify-inscription-event-credits").textContent = eventCredits;
    document.getElementById("modify-inscription-event-date").textContent = eventDate;
    document.getElementById("modify-inscription-event-time").textContent = eventTime;
    document.getElementById("button-register-to-event").setAttribute("data-event-id", eventId);
  } catch (error) {
    
  }




  toggleWindow("#window-inscription")

  // console.log(eventId);
}
async function registerToEvent(originButton) {
  const data = {
    op: "registerToEvent",
    event_id: originButton.getAttribute("data-event-id"),
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
    if(result == "already_registered"){
      message("No te puedes inscribir otra vez", "error");
      return false;
    }
    message("Inscripción exitosa", "success");
    toggleWindow();
    return true;
  }
  message("Hubo un error", "error");
  return false;
}
async function displayRegisteredEvents(completedFilter){
  if(completedFilter == undefined){ completedFilter = "false"; }
  const data = {
    op: "getRegisteredEvents",
    completed_filter: completedFilter
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
    if(completedFilter == "true"){
      document.getElementById("response-user-registered-completed-events").innerHTML = result;
      return true;
    }

    document.getElementById("response-user-registered-events").innerHTML = result;
    return true;
  }
}
async function cancelEventRegistration(originButton){
  const eventId = originButton.getAttribute("data-event-id");
  const data = {
    op: "cancelEventRegistration",
    event_id: eventId,
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
    message("Inscripción cancelada", "success");
    toggleWindow();
    displayRegisteredEvents();
    return true;
  }
  message("Hubo un error", "error");
  return false;
}

function toggleCancelEventWindow(originButton){
  const eventId = originButton.getAttribute("data-event-id");
  document.getElementById("button-confirm-cancel-event").setAttribute("data-event-id", eventId);
  toggleWindow("#window-cancel-event");
}

async function toggleEventRegisteredUsers(originButton){
  await getEventRegisteredUsers(originButton)

  document.getElementById("modify-event-registered-users-event-name").innerHTML = originButton.getAttribute("data-event-name");
  document.getElementById("modify-event-registered-users-event-credits").innerHTML = originButton.getAttribute("data-event-credits") + " créditos";
  document.getElementById("button-confirm-event-attendance").setAttribute("data-event-id", originButton.getAttribute("data-event-id"));
  toggleWindow("#window-event-registered-users");
}

async function getEventRegisteredUsers(originButton){
  const eventId = originButton.getAttribute("data-event-id");
  const data = {
    op: "getEventRegisteredUsers",
    event_id: eventId,
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
    document.getElementById("response-event-registered-users").innerHTML = result;
    return true;
  }
}
async function setUserEventAbsences(originButton){
  const userId = originButton.getAttribute("data-user-id");
  const eventId = originButton.getAttribute("data-event-id");
  const data = {
    op: "setUserEventAbsences",
    user_id: userId,
    event_id: eventId,
  };
  const url = "controllers/events.controller.php";
  try {
    const response = await fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
    });
    if (response.ok) {
      const result = await response.json();
      if (!result) {
        message("Hubo un error", "error");
        originButton.setAttribute("selected", "");
        return false;
      }

      return true;
    }else{
      originButton.setAttribute("selected", "");
    }

  } catch (error) {
    originButton.setAttribute("selected", "");
  }
  
  
  message("Hubo un error", "error");
  return false;

}
async function registerAttendance(originButton){
  const eventId = originButton.getAttribute("data-event-id");
  const data = {
    op: "registerAttendance",
    event_id: eventId,
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
    message("Asistencia registrada", "success");
    getEventsTable();
    toggleWindow();
    return true;
  }
  message("Hubo un error", "error");
  return false;
}

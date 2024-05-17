function toggleSection(sectionId){
  if (!sectionId) {return};

  const bottombar = document.querySelector("BOTTOMBAR");

  const activeSection = document.querySelector("section.active");
  const activeSelector = document.querySelector("selector.active");
  const activeSelectorBottom = bottombar.querySelector("selector.active");
  if(("#"+activeSection.id) === sectionId){return;}
  if (activeSelector) { activeSelector.classList.remove("active"); }
  if (activeSelectorBottom) { activeSelectorBottom.classList.remove("active"); }
  activeSection.classList.remove("active");

  // section is the section to open 
  if (sectionId == "history_back") {
    sectionId = localStorage.getItem("lastSection");
  }
  const section = document.querySelector(sectionId);
  const sidebarSelector = document.querySelector("#sel-" + sectionId.split("-")[1]);
  const bottomSelector = document.querySelector("#btmSel-" + sectionId.split("-")[1]);
  section.classList.toggle("active");
  if(sidebarSelector){sidebarSelector.classList.toggle("active");}
  if(bottomSelector){bottomSelector.classList.toggle("active");}
  localStorage.setItem("lastSection", "#"+activeSection.id); 

  holder = document.querySelector("holder");
  holder.scrollTop = 0

  
  // specific functions per section
  switch (sectionId) {
    case "#section-start": break;
    case "#section-events":
      if((window.location.pathname) == "/forolince/home"){
        displayRegisteredEvents();
        displayRegisteredEvents("true");
      }
      break;
    case "#section-admin-news":
      displayAdminNewsTable(0, 7);
      break;
    case "#section-admin-users":
      getAllUsersDataTable();
      break;

    default: break;
  }

  localStorage.setItem("currentSection", sectionId); 

  // With this we can reset responses
  lastSection = getStorage("lastSection");
  switch (lastSection) {
    case "#section-calendarDayAppts":
      resetDisplayDayEvents();
      break;
  }
    
}
function toggleWindow(windowId, position, scale){
  if (windowId == ''){windowId = null}

  // Close any other open window
  const transparent = document.querySelector('transparent');
  const activeWindow = transparent.querySelector('window.active');

  function closingAnimation() {
    if (transparent.hasAttribute("closing")) {
      transparent.classList.remove('active');
      transparent.removeAttribute("closing");
      
      activeWindow.classList.remove('active');
    }
  }

  if (activeWindow) {
    if (transparent.hasAttribute("closing")) { return; }
    toggleOvermessage();

    // This attribute added and all makes the close animation smooth
    transparent.setAttribute("closing", "");
    transparent.addEventListener("animationend", () =>{closingAnimation()}, {once: true})
    
    if (windowId !== "minimize") {
      resetForm();      
    }
    return;
  }
  if (transparent.hasAttribute("closing") && transparent.classList.contains("active")) {
    transparent.removeAttribute("closing");
  }

  // remove useless classes
  transparent.classList.remove('dynamic', 'right', 'left', 'top', 'bottom');


  // Window to open
  const windowNew = document.querySelector(windowId);
  if (!windowNew) { return; }
  transparent.classList.add('active'); 
  localStorage.setItem("currentWindow", windowId); 

  

  // Set origin element of animation
  if (event && event.currentTarget) {
    element = event.currentTarget;
    windowNew.classList.remove("not-animated");
  }else{
    element = null;
    windowNew.classList.add("not-animated");
  }

  // specific functions per window
  switch (windowId) {
    case "#window-create_movement": 
      setInputDate();
    break;
    case "#window-account": 
      getUserData()
    break;

    default: break;
  }

  // Set element with Dynamic position
  if(position == "absolute"){
    windowNew.classList.add("absolute");
    var rect = element.getBoundingClientRect();
    screenWidth = window.innerWidth;
    screenHeight = window.innerHeight;
    // Tests
    
    

    if (rect.left < (screenWidth/2)) {
      windowNew.style.right = "unset";
      windowNew.style.left = Math.round(rect.left)+"px";
      transparent.classList.add("left");
    } else{
      windowNew.style.left = "unset";
      windowNew.style.right = screenWidth-Math.round(rect.right)+"px";
      transparent.classList.add("right");
    }

    if (rect.top < (screenHeight/2)) {
      windowNew.style.bottom = "unset";
      windowNew.style.top = (Math.round(rect.top) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("top");

    }else{
      windowNew.style.top = "unset";
      windowNew.style.bottom = (screenHeight-Math.round(rect.bottom) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("bottom");
    }
    
    
    requestAnimationFrame(function() {
      var windowHeight = windowNew.offsetHeight;
      var windowBottom = screenHeight - (windowNew.offsetTop + windowNew.offsetHeight);
      
      var windowWidth = windowNew.offsetWidth;

    });
  }
  if(scale === undefined){scale = 0}else{scale = 1}
  animate(element, windowNew, position, scale);
}
function toggleOvermessage(overId){
  if (overId == ''){overId = null}

  const currentWindow = document.querySelector(getStorage("currentWindow")); 

  // Close
  const activeOvermessage = currentWindow.querySelector(".overmessage.active");
  function closingAnimation() {
    if (activeOvermessage.hasAttribute("closing")) {
      activeOvermessage.classList.remove('active');
      activeOvermessage.removeAttribute("closing");
    }
  }
  if (activeOvermessage) {
    activeOvermessage.setAttribute("closing", "");
    activeOvermessage.addEventListener("animationend", () =>{closingAnimation()}, {once: true})
    return;
  }
  if (activeOvermessage) {
    if (activeOvermessage.hasAttribute("closing") && activeOvermessage.classList.contains("active")) {
      activeOvermessage.removeAttribute("closing");
    }
  }
  

  // Open
  const overmessage = currentWindow.querySelector(overId);
  if(!overmessage){ return; }
  overmessage.classList.add("active");

}
function animate(element, windowNew, position, scale){
  let easeType = CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 ");
  if(position === "absolute" && window.innerWidth >= 681){
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 -0.003,0.896 0.325,1.044 0.653,1.191 0.585,0.935 1,1 ");
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.026,0.939 0.335,1.013 0.685,1.097 0.585,0.935 1,1 ");
    easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.04,0.951 0.335,1 0.684,1.057 0.614,0.964 1,1");
    // easeType = CustomEase.create("custom", "M0,0 C0.249,-0.124 0.045,0.925 0.335,1 0.625,1.074 0.532,0.987 1,1");
  }

  if (scale === 0 || window.innerWidth >= 681) {
    var scaleValue = true;
  }else{
    var scaleValue = false;
  }


  
  let state = Flip.getState(element);
  windowNew.classList.toggle('active');
  Flip.from(state, {
    targets: windowNew,
    duration: 0.5,
    scale: scaleValue,
    ease: easeType,
    // ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
    // ease: CustomEase.create("easeName", ".47,.29,0,1"),
    // ease: CustomEase.create("easeName", ".58,.18,0,1"),
    // ease: CustomEase.create("easeName", ".21,.19,0,1"),
    // ease: CustomEase.create("emphasized", "0.2, 0, 0, 1"),
    // ease: CustomEase.create("classic", "0.1, 0.8, 0, 1"),
    // ease: CustomEase.create("classic", "0.4, 0.4, 0, 1.2"),
    // ease: CustomEase.create("custom", "M0,0 C0.099,0 0.133,0.915 0.325,1.044 0.642,1.257 0.64,0.938 1,1 "),
    // ease: CustomEase.create("custom", "M0,0 C0.249,-0.124 -0.003,0.896 0.325,1.044 0.653,1.191 0.585,0.935 1,1 "),
    absolute: true,
  })
    
}

// Main complementary functions
function resetForm(specificParent){
  if (specificParent) {
    checkParent = document.querySelector(specificParent);
    inputs = checkParent.querySelectorAll('input:not(.no-reset) , textarea, select:not(.no-reset)');
  }else{
    inputs = document.querySelectorAll('input:not(.no-reset) , textarea, select:not(.no-reset)');
  }
  
  for (let i=0; i<inputs.length; i++){
    inputs[i].value = inputs[i].defaultValue;
    inputs[i].style.backgroundColor = "";
    inputs[i].classList.remove('error');
  }
  if(document.getElementById('end_service-new_selects') !== null){
    document.getElementById('end_service-new_selects').innerHTML = '';
  }
  button = document.querySelector("BUTTON")
  if(button){
    button.disabled = false;
  }
}
function checkEmpty(parentId, element, type){
  parent = document.querySelector(parentId);
  inputs = parent.querySelectorAll(element);
  validation = 0;
  for (let i=0; i<inputs.length; i++){
    inputs[i].addEventListener("focus", function() {inputs[i].classList.remove('error')}, {once: true});
    if(inputs[i].value === "" || inputs[i].value === "0"){ 
      validation = 1; 
      inputs[i].classList.add('error');
    }
  }
  // console.log(validation);
  if(validation != 0){
    if(type==="dialog"){toggleWindow("#empty_spaces")} 
    return false;
  }else{
    return true
  }
}
function loadAnimation(parentId, action) {
  var parent = document.querySelector(parentId);
  var circle = parent.querySelector("circle");
  var circleHolder = parent.querySelector("circleHolder");

  if (action) {
    if (!circle) {
      if (!circleHolder) {
        circleHolder = document.createElement("circleHolder");
        parent.appendChild(circleHolder);
      }
      circle = document.createElement("circle");
      circleHolder.appendChild(circle);
    } else {
      console.log("El elemento ya existe");
    }
  } else {
    if (circle) {
      circle.remove();
    }
    if (circleHolder) {
      circleHolder.remove();
    }
  }
}
function toggleButton(windowId, action){
  openWindow = document.querySelector(windowId);
  button = openWindow.querySelectorAll('BUTTON');
  lastButton = button[button.length - 1];
  if(action){
    lastButton.disabled = true;
  }else{
    lastButton.disabled = false;
  }
}
let currentTimeoutId = null;
function message(message, action){
  const messageElement = document.querySelector("MESSAGE");
  if (action === "error") {messageElement.classList.add('error'); image = ''}
  else if(action === "done"){messageElement.classList.add('done'); image = ''}
  else{image='';}
  
  messageElement.innerHTML = image + message;
  messageElement.style.display = "flex";
  messageElement.style.animation = "messageIn 0.7s cubic-bezier(.11,.86,0,.99)";
  if (currentTimeoutId) {clearTimeout(currentTimeoutId);}
  currentTimeoutId = setTimeout(() => {
      messageElement.style.animation = "messageOut 0.8s";
      setTimeout(() => {messageElement.style.display = "none"; currentTimeoutId = null;}, 700);
  }, 4000);
}

// Sub Structure Functions
function setStorage(varName, value){
  localStorage.setItem(varName, value); 
}
function getStorage(varName){
  return localStorage.getItem(varName);
}
function toggleSidebar(){
  sidebar = document.querySelector("SIDEBAR");
  sidebar.classList.toggle("minimize");
}

function toggleMenu(button){
  const sidebar = document.querySelector("SIDEBAR");
  sidebar.classList.toggle("minimized");
  
  buttonText = button.querySelector("DIV");

  if (sidebar.classList.contains("minimized")) {  
    buttonText.innerHTML = '<span class="material-symbols-rounded">side_navigation</span>'
  }else{
    buttonText.innerHTML = 'Menú';
  }
  
}

function changeWindow(windowId){
  toggleWindow();
  setTimeout(function() {
    toggleWindow(windowId);
  },250);
}


// Ripple Effect || ripple_effect
document.addEventListener('mousedown', (event) => {
  if (event.target.classList.contains('ripple_effect')) {

    var body = document.querySelector('body');
    var x, y;
    
    if (event.target.tagName === 'BUTTON') { // Si el elemento es un botón
      var rect = event.target.getBoundingClientRect();
      x = event.clientX - rect.left;
      y = event.clientY - rect.top;
    } else { // Si el elemento es un enlace
      x = event.offsetX;
      y = event.offsetY;
    }
    
    var ripples = document.createElement('ripple');
    var size = event.target.offsetWidth * 2;
    ripples.style.left = x - size/2 + 'px';
    ripples.style.top = y - size/2 + 'px';
    event.target.appendChild(ripples);
    ripples.style.width = ripples.style.height = size + 'px';

    setTimeout(() => {
      ripples.remove();
    }, 1000);
  }
});
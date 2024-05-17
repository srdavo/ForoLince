<window id="window-logout" class="dialog" data-flip-id="animate">
    <!-- <section>
        <h2>Cerrar sesión</h2>
        <p>¿Estas seguro de que quieres cerrar sesión?</p>
        <button class="toolbar-button" onclick="toggleWindow()">Cancelar</button>
        <button class="toolbar-button ripple_effect" onclick="localStorage.setItem('currentSection', ''); window.location='controllers/logout.php'">Cerrar sesión</button>
    </section> -->
    <section>
        <h1>Cerrar sesión</h1>
        <h2 class="info">¿Estas seguro de que quieres cerrar sesión?</h2>
        <button class="color-background" onclick="toggleWindow()">Cancelar</button>
        <button class="color-normalNeutral textcolor-error ripple_effect" onclick="localStorage.setItem('currentSection', ''); window.location='controllers/logout.php'">Cerrar sesión</button>
    </section>
</window>

<window id="window-account" class="increased slim h-auto" data-flip-id="animate">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section>
        <h1>Cuenta</h1>
        <div class="data_box modern large">
            <datatitle>Id de la cuenta</datatitle>
            <data id="response-account-id">...</data>
        </div>
        <div class="data_box modern">
            <datatitle>Correo de la cuenta</datatitle>
            <data id="response-account-email">...</data>
        </div>
        <div class="data_box modern large">
            <datatitle>Tus créditos</datatitle>
            <data><?php echo $_SESSION["additional_data"]["credits"]?></data>
        </div>
        <div class="data_box modern large">
            <datatitle>Tipo de cuenta</datatitle>
            <data>
                <?php 
                    switch ($_SESSION["additional_data"]["permissions"]) {
                        case '1':
                            echo "Profesor";
                            break;
                        case '7':
                            echo "Superusuario / Administrador";
                            break;
                        
                        default:
                            echo "Estudiante";
                            break;
                    }
                ?>
            </data>
        </div>
        <div class="simple_container">
            <span class="modern-input">
                <label for="modify-account-username">Nombre de usuario</label>
                <input type="text" placeholder="Crea un nombre de usuario" id="modify-account-username">
            </span>
        </div>
        
        
        <button onclick="modifyUserData()" class="color-primary ripple_effect">Guardar</button>
    </section>
</window>

<window id="window-example_big" class="increased" data-flip-id="animate">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section>
        <h1>Ventana grande</h1>
    </section>
</window>

<window id="window-create_news" class="increased slim h-auto" data-flip-id="animate">

    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>

    <section >
        <h1>Crear Noticia</h1>
        
        <div class="simple_container">
            <span class="modern-input">
                <label for="create-new_title">Título</label>
                <input type="text" placeholder="Agregar el Título a la noticia" id="create-new_title">
            </span>

            <span class="modern-input">
                <label for="create-new_content">Contenido</label>
                <textarea id="create-new_content" cols="30" rows="10" placeholder="Agregar el Contenido de la noticia"></textarea>
            </span>

            <span class="modern-input">
                <label for="create-new_image">Imagen</label>
                <input type="text" placeholder="URL de imagen" id="create-new_image">
            </span>
        </div>

        <button onclick="createNew()" class="color-primary ripple_effect">
            Publicar noticia
        </button>

    </section>

</window>
<window id="window-edit_news" class="increased slim h-auto" data-flip-id="animate">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>

    <section>
        <h1>Editar noticia</h1>
        <div class="simple_container">
            <span class="modern-input">
                <label for="edit-new_title">Título</label>
                <input type="text" placeholder="Agregar el Título a la noticia" id="edit-new_title">
            </span>

            <span class="modern-input">
                <label for="edit-new_content">Contenido</label>
                <textarea id="edit-new_content" cols="30" rows="10" placeholder="Agregar el Contenido de la noticia"></textarea>
            </span>

            <span class="modern-input">
                <label for="edit-new_image">Imagen</label>
                <input type="text" placeholder="URL de imagen" id="edit-new_image">
            </span>
        </div>

        <button onclick="editNew(this)" id="button-confirm-edit-new" class="color-primary ripple_effect">
            Guardar cambios
        </button>
    </section>
</window>

<window id="window-create_event" class="increased mini h-auto" data-flip-id="animate" >
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
        <button onclick="toggleWindow('minimize')" class="action"><span class="material-symbols-rounded">horizontal_rule</span></button>
    </toolbar>
    <section style="gap:12px">
        
        <h1 class="ultra-large">Crea un evento</h1>

        <div class="content_box small invisible">
            <div class="simple_container">
                <span class="modern-input">
                    <label for="create-event_name">Nombre</label>
                    <input type="text" id="create-event_name" placeholder="Nombre del evento">
                </span>
                <span class="modern-input">
                    <textarea id="create-event_description" cols="30" rows="14" class="modern" placeholder="Descripción del evento"></textarea>
                </span>
            </div>

        </div>
        <div class="content_box small invisible">
            <div class="simple_container">

            <span class="modern-input">
                <label for="create-event_credits">Créditos a entregar</label>
                <input type="number" id="create-event_credits" placeholder="Créditos del evento">
            </span>
            
            <div class="content_box invisible">
                <div class="content_box invisible small">
                    <span class="modern-input">
                        <label for="create-event_date">Fecha</label>
                        <input type="date" id="create-event_date">
                    </span>
                </div>
                <div class="content_box invisible small">
                    <span class="modern-input">
                        <label for="create-event_time">Hora</label>
                        <input type="time" id="create-event_time">
                    </span>
                </div>
            </div>
           
            <span class="modern-input">
                <label for="create-event_address">Dirección</label>
                <input type="text" id="create-event_address" placeholder="Lugar del evento">
            </span>
            <span class="modern-input">
                <label for="create-event_image">Imagen del evento</label>
                <input type="text" id="create-event_image" placeholder="URL de imagen">
            </span>

            <button onclick="createNewEvent()" class="big-button ripple_effect color-primary" >
                <span class="material-symbols-rounded dynamic fill">add</span>
                Crear evento
            </button>
            </div>
        </div>


        
    </section>
    
</window>


<window id="window-edit_event" class="increased mini h-auto" data-flip-id="animate">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section style="gap:12px">
        
        <h1 class="ultra-large">Editar evento</h1>

        <div class="content_box small invisible">
            <div class="simple_container">
                <span class="modern-input">
                    <label for="edit-event_name">Nombre</label>
                    <input type="text" id="edit-event_name" placeholder="Nombre del evento">
                </span>
                <span class="edit-input" style="width:100%">
                    <textarea id="edit-event_description" cols="30" rows="14" class="modern" placeholder="Descripción del evento"></textarea>
                </span>
            </div>

        </div>
        <div class="content_box small invisible">
            <div class="simple_container">

            <span class="modern-input">
                <label for="edit-event_credits">Créditos a entregar</label>
                <input type="number" id="edit-event_credits" placeholder="Créditos del evento">
            </span>
            
            <div class="content_box invisible">
                <div class="content_box invisible small">
                    <span class="modern-input">
                        <label for="edit-event_date">Fecha</label>
                        <input type="date" id="edit-event_date">
                    </span>
                </div>
                <div class="content_box invisible small">
                    <span class="modern-input">
                        <label for="edit-event_time">Hora</label>
                        <input type="time" id="edit-event_time">
                    </span>
                </div>
            </div>
           
            <span class="modern-input">
                <label for="edit-event_address">Dirección</label>
                <input type="text" id="edit-event_address" placeholder="Lugar del evento">
            </span>
            <span class="modern-input">
                <label for="edit-event_image">Imagen del evento</label>
                <input type="text" id="edit-event_image" placeholder="URL de imagen">
            </span>

            <button id="button-edit-event" data-event-id="0" onclick="editEvent(this)" class="big-button ripple_effect color-primary" >
                <span class="material-symbols-rounded dynamic fill">save</span>
                Guardar cambios
            </button>
            </div>
        </div>


        
    </section>
</window>

<window id="window-delete_event_confirmation" class="dialog" data-flip-id="animate">
    <section>
        <h1>Eliminar evento</h1>
        <h2 class="info">¿Estas seguro de que quieres eliminar este evento?</h2>
        <button class="color-background" onclick="toggleWindow()">Cancelar</button>
        <button class="color-error ripple_effect" onclick="deleteEvent(this)" id="button-confirm-delete-event" confirm-delete>Eliminar</button>
    </section>
</window>

<window id="window-delete_new_confirmation" class="dialog" data-flip-id="animate">
    <section>
        <h1>Eliminar noticia</h1>
        <h2 class="info">¿Estas seguro de que quieres eliminar esta noticia?</h2>
        <button class="color-background" onclick="toggleWindow()">Cancelar</button>
        <button class="color-error ripple_effect" onclick="deleteNew(this)" id="button-confirm-delete-new" confirm-delete>Eliminar</button>
    </section>
</window>

<window id="window-cancel-event" class="slim">
    <section class="gap-8">
        <div class="simple-container-direction-column v-margin">
            <h1>Cancelar inscripción</h1>
            <h2 class="info">¿Estas seguro de que quieres cancelar tu inscripción a este evento?</h2>
        </div>
        
        <div class="simple-container grow-1 justify-right gap-8">
            <button class="color-outline" onclick="toggleWindow()">Cancelar</button>
            <button class="error on-error-text ripple_effect" onclick="cancelEventRegistration(this)" id="button-confirm-cancel-event" confirm-cancel>Cancelar inscripción</button>
        </div>
        
    </section>
</window>

<window id="window-event-registered-users" data-flip-id="animate">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section>
        <h1>Registro de asistencia</h1>
        <div class="content-box grow-1 direction-row gap-16">
            <div class="simple-container direction-column gap-8">
                <span class="headline-small" id="modify-event-registered-users-event-name">...</span>
                <span class="body-large data-line color-primary" id="modify-event-registered-users-event-credits">...</span>
            </div>
        </div>
        <div class="content-box grow-1">
            <span class="headline-small">Tomar asistencia</span>
            <span class="body-large">Aquí puedes registrar la asistencia de los usuarios que han participado en el evento y asignar los créditos correspondientes</span>
        </div>
        <div class="simple-container grow-1" id="response-event-registered-users"></div>
        <div class="simple-container grow-1 width-100 gap-16 justify-between">
            <div class="content-divisor">
                <p class="info">
                    A confirmar la asistencia de los usuarios, se les asignarán los créditos correspondientes y no se podrán hacer cambios al evento.
                </p>
            </div>
            <div class="content-divisor grow-1">
                <button id="button-confirm-event-attendance" class="big-button color-primaryNeutral ripple_effect" onclick="registerAttendance(this)">
                    <span class="material-symbols-rounded dynamic fill">verified</span>
                    Confirmar asistencia
                </button>

            </div>
        </div>
    </section>
</window>

<window id="window-edit-user-credits" class="dialog" data-flip-id="animate">
    <section>
        <h1 style="margin-top:24px;">Modificar créditos</h1>
        <div class="simple-container grow-1 direction-column">
            <span class="modern-input">
                <label for="edit-user-credits">Escribe nueva cantidad</label>
                <input type="number" id="edit-user-credits" placeholder="00">
            </span>
            <div class="simple-container justify-right gap-8">
                <button class="color-outline ripple_effect" onclick="toggleWindow()">Cancelar</button>

                <button onclick="editUserCredits(this)" id="button-confirm-edit-user-credits" class="color-primary ripple_effect">Guardar</button>
            </div>
        </div>
    </section>
</window>

<window id="window-edit-user-permissions" class="" data-flip-id="animate">
    <section>
        <h1 style="margin-top:24px;">Modificar permisos del usuario</h1>
        <div class="simple-container grow-1 direction-column">
            <span class="modern-input">
                <label for="edit-user-permissions">Selecciona el nivel de permisos</label>
                <select name="" id="edit-user-permissions">
                    <option value="0">Nivel 0: Estudiante</option>
                    <option value="1">Nivel 1: Profesor</option>
                    <option value="7">Nivel 7: Superusuario / Administrador</option>
                </select>
            </span>
            <div class="simple-container justify-right gap-8">
                <button class="color-outline ripple_effect" onclick="toggleWindow()">Cancelar</button>

                <button onclick="editUserPermissions(this)" id="button-confirm-edit-user-permissions" class="color-primary ripple_effect">Guardar</button>
            </div>
        </div>
    </section>
</window>





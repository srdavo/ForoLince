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
                <label for="create-news-title">Título Noticia</label>
                <input type="text" placeholder="Agregar el Título" id="create-news-title">
            </span>

            <span class="modern-input">
                <label for="create-news-description">Descripción Noticia</label>
                <textarea id="create-news-description" cols="30" rows="10" placeholder="Agregar la Descripción"></textarea>
            </span>
        </div>

        <button onclick="" class="color-primary ripple_effect">Guardar</button>

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

<style>
    textarea{
        width: 91%;
        padding-top: 46px;
        background: var(--surfaceMediumSolid);
        box-shadow: none;
        border-radius: 16px;
        font-size:17px;
        line-height: 22px;
        border: none;
        outline: none;
        text-align: left;
        font-family: 'Inter', sans-serif;
        color: rgba(var(--normalInverted), 1);
    }

    textarea::placeholder{color: rgba(var(--normalInverted), 0.2);}
</style>
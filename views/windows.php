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
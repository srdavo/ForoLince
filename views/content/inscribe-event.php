<toolbar>
    <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
</toolbar>
<section>
    <div class="simple-container gap-8 direction-column grow-1 b-margin">
        <h1 class="large">Inscripción</h1>
        <div class="data_box modern large">
            <datatitle>Nombre del evento</datatitle>
            <data id="modify-inscription-event-name">-</data>
        </div>
        <div class="data_box modern large">
            <datatitle>Créditos</datatitle>
            <data id="modify-inscription-event-credits" class="color-primary">-</data>
        </div>
        <div class="simple-container gap-8">
            <div class="data_box modern ">
                <datatitle>Fecha</datatitle>
                <data id="modify-inscription-event-date">-</data>
            </div>
            <div class="data_box modern ">
                <datatitle>Hora</datatitle>
                <data id="modify-inscription-event-time">-</data>
            </div>
        </div>
        <div class="simple-container direction-column gap-8">
            <button onclick="registerToEvent(this)" id="button-register-to-event" class="big-button flex-button color-primaryNeutral ripple_effect">
                <span class="material-symbols-rounded dynamic fill">event_upcoming</span>
                Confirmar inscripción
            </button>
            <button onclick="toggleWindow()" class="big-button color-outline">Cancelar</button>
        </div>
        
    </div>
</section>
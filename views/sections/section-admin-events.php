<section id="section-admin-events">

    <div class="simple-container-direction-column gap-8 grow-1">
        <div class="simple-container grow-1 b-margin" onclick="toggleSection('history_back')">
            <md-icon-button>
                <md-icon>arrow_back</md-icon>
            </md-icon-button>
        </div>
        <div class="simple-container grow-1 justify-between b-margin gap-8">
            <div class="content-divisor">
                <h1>Eventos</h1>
                <h2>Visualiza los eventos que has creado</h2>
            </div>
            <div class="content-divisor">
                <button 
                    class="color-primary ripple_effect"
                    onclick="toggleWindow('#window-create_event')"
                    data-flip-id="animate">
                    + Crear evento
                </button>
            </div>
        </div>

        

        <div class="response_holder" id="response-events_table"></div>
                

    </div>
    
    
</section>
<section id="section-admin-news">
    <div class="simple-container-direction-column gap-8 grow-1">
        <div class="simple-container grow-1 b-margin" onclick="toggleSection('history_back')">
            <md-icon-button>
                <md-icon>arrow_back</md-icon>
            </md-icon-button>
        </div>
        <div class="simple-container grow-1 justify-between b-margin gap-8">
            <div class="content-divisor">
                <h1>Noticias</h1>
                <h2>Modera las noticias creadas por todos los usuarios</h2>
            </div>
            <div class="content-divisor">
                <button
                    onclick="toggleWindow('#window-create_news')"
                    class="ripple_effect color-primary"
                    data-flip-id="animate"
                    >
                    + Crear noticia
                </button>
            </div>
        </div>

        

        <div class="response_holder" style='overflow:visible' id="response-admin-news-table"></div>
                

    </div>
</section>
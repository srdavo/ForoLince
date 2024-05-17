<section id="section-home" class="active" style="padding:16px;">

    <div class="simple-container grow-1 direction-column gap-8" style="height:100%">



        <div class="simple-container direction-column grow-1 rounded" style="position:relative; min-height:268px; width-100">
            <div class="simple-container grow-1 padding-24 direction-column" style="z-index:1;">
                <!-- first row -->
                <div class="simple-container direction-column gap-16">
                    <div class="headline-medium square data-line secondary on-secondary-text">forolince</div>
                    <div class="simple-container direction-column">
                        <h1 class="ultra-large bricolage">Bienvenido</h1>
                        <h1 class="super-ultra-large bricolage on-secondary-container-text"><?php echo $_SESSION["user"] ?></h1>
                    </div>
                </div>
                <!-- space -->
                <div class="simple-container grow-1"></div>
                <!-- second row -->
                <div class="simple-container direction-row">
                    <div class="data_box modern">
                        <datatitle>Tus créditos</datatitle>
                        <data><?php echo $_SESSION["additional_data"]["credits"]?></data>
                    </div>
                </div>
            </div>
            <div class="secondary-container special-container" style="z-index:0;width:100%; height:100%; position:absolute; left:0; top:0; opacity:0.5; border-radius:32px"></div>
        </div>
        <div class="simple-container width-100 gap-8 ">
            
            <div class="content-box card small align-center" onclick="toggleSection('#section-news')">
                <md-ripple></md-ripple>
                <md-icon class="pretty small">newspaper</md-icon>
                <span class="body-large">Ir a noticias</span>
            </div>
            <div class="content-box card small align-center" onclick="toggleSection('#section-events')">
                <md-ripple></md-ripple>
                <md-icon class="pretty small">event</md-icon>
                <span class="body-large">Ir a eventos</span>
            </div>
        </div>
    </div>

</section>
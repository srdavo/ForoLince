<window id="window-inscription" data-flip-id="animate">
    <?php
        if (!(isset($_SESSION['id']))) {
            echo "
                <section style='padding:48px'>
                    <span class='material-symbols-rounded pretty fill'>person_add</span>
                    <h2 class='b-margin'>Para inscribirte a un evento primero accede o crea una cuenta como estudiante o profesor</h2>
                    <button class='flex-button color-normalNeutral ripple_effect' onclick='toggleWindow()'>
                        Cancelar
                    </button>
                    <button class='flex-button color-primaryNeutral ripple_effect' onclick='window.location=\"index\"'>
                        <span class='material-symbols-rounded dynamic fill r-margin'>login</span>
                        Iniciar sesión
                    </button>
                </section>
            ";
        }else{
            include_once 'views/content/inscribe-event.php';
        }

    ?>
</window>


<window id="window-events" data-flip-id="animate" class="increased">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section>
        
    </section>
</window>


<window id="window-new" data-flip-id="animate" class="">
    <toolbar>
        <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
    </toolbar>
    <section>
        <div class="simple_container">
            <h1 class="ultra-large">Doritos Prohibidos</h1>
            <dataline class="color-primaryNeutral">Nueva</dataline>
            <!-- <dataline class="color-primaryNeutral">14 de Febrero</dataline> -->
            <!-- <h2>14 de Febrero</h2> -->
        </div>
        <div class="simple_container">
            <p class="info">14 de Febrero, 2024</p>
            <p class="info">Autor: Luis David Elizarraraz Mondaca</p>
        </div>
        <p class="text">
            Estudiantes de la Universidad Autónoma de Sinaloa se encuentran en shock después de que la administración anunciara la prohibición de la venta de Doritos en todos los campus.
            La medida, que entró en vigor el lunes 12 de febrero, ha generado una ola de reacciones encontradas entre los estudiantes. Algunos aplauden la decisión, argumentando que los Doritos son una fuente poco saludable de calorías y grasas. Otros, sin embargo, consideran la prohibición como un ataque a su libertad de elección.
            La administración de la universidad ha justificado la medida como parte de un esfuerzo por promover hábitos alimenticios saludables entre los estudiantes. Afirman que la venta de Doritos en el campus contribuía a la alta tasa de obesidad entre la población estudiantil.
            Los estudiantes que no estén dispuestos a renunciar a sus Doritos tendrán que buscar alternativas fuera del campus. Algunos ya han comenzado a organizar "fiestas clandestinas de Doritos" en sus residencias.
            La prohibición de Doritos en la Universidad Autónoma de Sinaloa es un tema que sin duda seguirá generando debate. Es probable que la medida inspire a otras universidades a tomar medidas similares en un esfuerzo por promover la salud de sus estudiantes.
        </p>
        <toolbar class="invisible">
            <div class="toolbar_divisor">
                <button class="flex-button color-normal small ripple_effect">
                    Más noticias de este autor
                </button>
            </div>
            <div class="toolbar_divisor">
               
            </div>
        </toolbar>
    </section>
</window>
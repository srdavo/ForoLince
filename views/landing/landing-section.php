<section id="section-start" class="active">
    <div class="simple-container justify-between grow-1 gap-16 titles-box">
        <div class="content-divisor">
            <h1 class="super-ultra-large emphasized-light bricolage">Foro Lince</h1>
        </div>
        <div class="content-divisor">
            <h2 class="large bricolage" style="width:auto;">Descubre la vaguardia académica<br>en Universidad Lince</h2>
        </div>
        
    </div>
 



    <div class="content_box invisible img_holder" style="border-radius:40px; overflow:hidden; max-height:800px">
        <!-- <img src="https://th.bing.com/th/id/OIG4.K10CT_jBPYAY8fAa5dkx?pid=ImgGn"> -->
        <img src="resources/university_img.jpg">

        <!-- https://th.bing.com/th/id/OIG1.3WDAuhAym56pCdHToxAN?w=1024&h=1024&rs=1&pid=ImgDetMain -->
        <!-- https://get2.imglarger.com/upscaler/results/BC102Lfx_2x.jpg -->
    </div>

    <div class="vf_container visual_frame invisible" id="cards_holder" style="height:auto; margin:64px 0">
        <div class="visual_frame small add_padding">
            <h1 class="large ">Eventos</h1>
            <!-- <h1 class="large">Explora la agenda completa de eventos de la universidad.</h1> -->
            <img src="resources/pretty_img_1.png" class="img-card" alt="">
            <h2 class="info">Explora la agenda completa de eventos de la universidad.</h2>
            
            <button onclick="toggleSection('#section-events')" class="color-primary ripple_effect landing-button">Ir</button>
        </div>
        <div class="visual_frame small add_padding">
            <h1 class="large">Inscripciones</h1>
            <img src="resources/pretty_img_2.png" class="img-card" alt="">
            <h2 class="info">Inscríbete fácilmente a los eventos que te interesen.</h2>
            
            <button onclick="toggleWindow('#window-inscription')" class="color-primary ripple_effect landing-button" data-flip-id="animate">Ir</button>
        </div>
        <div class="visual_frame small add_padding">
            <h1 class="large">Noticias</h1>
            <img src="resources/pretty_img_3.png" class="img-card" alt="">
            <h2 class="info">Mantente informado sobre las últimas novedades de la universidad.</h2>
            <button onclick="toggleSection('#section-news')" class="color-primary ripple_effect landing-button">Ir</button>
        </div>
    </div>

    <div class="content_box centered outline" style="padding: 48px 24px">
        <span class="material-symbols-rounded pretty fill">person_add</span>
        <h2 class="b-margin">Accede o crea una cuenta como estudiante o profesor</h2>
        <button class="flex-button color-outline ripple_effect" onclick="window.location='index'">
            <span class="material-symbols-rounded dynamic fill r-margin">login</span>
            Iniciar sesión
        </button>
    </div>


</section>

<section id="section-events" style="position:relative;">
    <!-- <div class="title-img img-1">
        <h1 class="ultra-large">Eventos</h1>
    </div>     -->

    <div class="simple-container justify-between grow-1 gap-16 titles-box">
            <h1 class="super-ultra-large emphasized-light bricolage">Eventos</h1>
            <h2 class="large bricolage">Explora la agenda completa de eventos de la universidad.</h2>
    </div>



    <div class="content_box invisible pretty-content"  id="response-events_holder">

        <!-- <div class="response_holder" id="response-events_holder" style="overflow:visible;"></div> -->

        <!-- <event-item 
            data-img="https://helios-i.mashable.com/imagery/articles/01tKXBvpCMarePLfBPMImJd/images-3.fill.size_2000x1500.v1611691541.jpg"
            data-title="Música para la educación"
            data-description="Concierto benéfico para recaudar fondos para la educación en comunidades rurales."
            data-date = "14 de Febrero, 2024"
            onclick="toggleWindow('#window-events')" 
            data-flip-id="animate"
        ></event-item> -->
        
<!-- 
        <card-item>

        </card-item> -->
 

        <!-- <button class="big-button color-normalNeutral ripple_effect">
            Ver más eventos
            <span class="material-symbols-rounded fill">expand_more</span>
        </button> -->
    </div>
    


    
    
</section>

<section id="section-news">
    <div class="title-img img-2">
        <h1 class="ultra-large">Noticias</h1>
    </div>  
    <!-- <div class="content_box invisible news_card">
        <div class="content_box small"  style="max-width:300px">
            <div class="simple_contianer">
                <h1 class="ultra-large">Venta de doritos prohibida</h1>
                <h2>14 de Febrero 2024</h2>
                <p class="info">Autor: Luis David Elizarraraz Mondaca</p>
            </div>
            
        </div>
        <div class="content_box small">
            <h2>
            Estudiantes de la Universidad Autónoma de Sinaloa se encuentran en shock después de que la administración anunciara la prohibición de la venta de Doritos en todos los campus.
            La medida, que entró en vigor el lunes 12 de febrero, ha generado una ola de reacciones encontradas entre los estudiantes. Algunos aplauden la decisión, argumentando que los Doritos son una fuente poco saludable de calorías y grasas. Otros, sin embargo, consideran la prohibición como un ataque a su libertad de elección.
            La administración de la universidad ha justificado la medida como parte de un esfuerzo por promover hábitos alimenticios saludables entre los estudiantes. Afirman que la venta de Doritos en el campus contribuía a la alta tasa de obesidad entre la población estudiantil.
            Los estudiantes que no estén dispuestos a renunciar a sus Doritos tendrán que buscar alternativas fuera del campus. Algunos ya han comenzado a organizar "fiestas clandestinas de Doritos" en sus residencias.
            La prohibición de Doritos en la Universidad Autónoma de Sinaloa es un tema que sin duda seguirá generando debate. Es probable que la medida inspire a otras universidades a tomar medidas similares en un esfuerzo por promover la salud de sus estudiantes.
            </h2>
        </div>
    </div> -->
    <!-- <toolbar class="visible">
        <div class="toolbar_divisor">
            <button class="toolbar-button">
                <span class="material-symbols-rounded">calendar_month</span>
            </button>
        </div>
        <div class="toolbar_divisor"></div>
    </toolbar> -->

    <div class="news_card ripple_effect" onclick="toggleWindow('#window-new')" data-flip-id="animate">
        <div class="content_box invisible">
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
        </div>
        <span class="bottom-gradient"></span>
    </div>

    <div class="news_card" onclick="toggleWindow('#window-new')" data-flip-id="animate">
        <div class="content_box invisible">
            <div class="simple_container">
                <h1 class="ultra-large">New Research Findings</h1>
                <dataline class="color-primaryNeutral">Latest</dataline>
            </div>
            <div class="simple_container">
                <p class="info">March 1, 2022</p>
                <p class="info">Author: John Doe</p>
            </div>
            <p class="text">
                Exciting new research findings have been published by scientists at the University of Science. The study, conducted over a period of two years, reveals groundbreaking insights into the field of artificial intelligence.
                According to the research, the team has developed a new algorithm that outperforms existing models in various tasks, including image recognition and natural language processing. This breakthrough has the potential to revolutionize industries such as healthcare, finance, and transportation.
                The algorithm, named AI-Advancer, utilizes advanced neural networks and deep learning techniques to achieve unprecedented accuracy and efficiency. It has already attracted attention from major tech companies and is expected to be integrated into their products and services in the near future.
                The research team is now working on further enhancements to AI-Advancer and exploring its applications in other domains. They believe that this technology will pave the way for significant advancements in automation, decision-making, and problem-solving.
                The publication of these research findings has generated excitement and anticipation within the scientific community. Experts are eager to replicate and build upon the results, which could lead to even more remarkable discoveries in the field of artificial intelligence.
            </p>
        </div>
        <span class="bottom-gradient"></span>
    </div>  

    <div class="news_card">
        <div class="content_box invisible">
            <div class="simple_container">
                <h1 class="ultra-large">Nuevos Descubrimientos Científicos</h1>
                <dataline class="color-primaryNeutral">Últimos</dataline>
            </div>
            <div class="simple_container">
                <p class="info">1 de Marzo de 2022</p>
                <p class="info">Autor: Juan Pérez</p>
            </div>
            <p class="text">
                Emocionantes nuevos descubrimientos científicos han sido publicados por científicos de la Universidad de Ciencia. El estudio, realizado durante un período de dos años, revela ideas innovadoras en el campo de la inteligencia artificial.
                Según la investigación, el equipo ha desarrollado un nuevo algoritmo que supera a los modelos existentes en diversas tareas, incluyendo reconocimiento de imágenes y procesamiento de lenguaje natural. Este avance tiene el potencial de revolucionar industrias como la salud, las finanzas y el transporte.
                El algoritmo, llamado AI-Advancer, utiliza redes neuronales avanzadas y técnicas de aprendizaje profundo para lograr una precisión y eficiencia sin precedentes. Ya ha captado la atención de importantes empresas tecnológicas y se espera que se integre en sus productos y servicios en un futuro cercano.
                El equipo de investigación está trabajando en mejoras adicionales para AI-Advancer y explorando sus aplicaciones en otros ámbitos. Creen que esta tecnología abrirá el camino a avances significativos en la automatización, la toma de decisiones y la resolución de problemas.
                La publicación de estos descubrimientos científicos ha generado emoción y anticipación dentro de la comunidad científica. Los expertos están ansiosos por replicar y ampliar los resultados, lo que podría llevar a descubrimientos aún más notables en el campo de la inteligencia artificial.
            </p>
        </div>
        <span class="bottom-gradient"></span>
    </div>  

    <button class="big-button color-normalNeutral ripple_effect">
        Ver más noticias
        <span class="material-symbols-rounded fill">expand_more</span>
    </button>

</section>

<style>
    /* .card{
        max-width: 33%;
    } */
    /* Styles for main structure */

    div.titles-box{margin:64px 0; margin-top:24px;}
    .content_divisor{display:flex; flex-grow:1;justify-content: flex-start;}
    .content_divisor:last-of-type{justify-content: flex-end;}
    @media only screen and (max-width: 680px){
        div.titles-box{margin:32px 0; margin-top:16px;}
        .content_divisor:last-of-type{justify-content: flex-start;}
    }
    
    p.text{
        font-size:17px;
        line-height:22px;
    }

    .bottom-gradient{
        position:absolute;
        bottom:0;
        width:100%;
        height:48px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 0%, var(--surfaceMediumSolid) 80%);
        display:block;
    }

    div.news_card{
        position:relative;
        display:flex;
        justify-content: center;
        
        /* width:100%; */
        flex-basis:400px;
        flex-grow:1;   
        height:auto;
        
        overflow:auto;

        padding:24px;
        padding-bottom:0;

        background:var(--surfaceMedium);
        border-radius:24px;
        
        /* overscroll-behavior: contain; */
        box-sizing: border-box;
        cursor:pointer;
        /* border-bottom: 24px solid transparent; */
        /* border-image: linear-gradient(0turn, rgba(0,0,0, .5), rgba(255,255,255.0));
        border-image-slice: 150; */
    }
    /* div.news_card > * {pointer-events:none;} */
    div.news_card > div.content_box.invisible{
        border-radius:0;
        /* overscroll-behavior: contain; */
        max-height:400px;
        padding-bottom:24px;
        overflow:auto;

        min-width:unset;
        max-width:800px;
    }
    div.news_card > div.content_box.invisible::-webkit-scrollbar{
        display:none;
    }


    .news_card h1.ultra-large{
        line-height: 40px;
        margin-bottom:8px;
    }

    /* .info{
        width:Auto;
    } */
    .title-img{
        display:flex;
        align-items: center;
        padding:48px;
        width:100%;
        height:164px;

        border-radius:48px;

        background-position: center;
        background-size: cover;
    }
    .img-1{background-image:url("resources/pretty_img_1.png");}
    .img-2{background-image:url("resources/pretty_img_3.png");}
    .title-img h1{
        font-weight:700;
        font-size:120px;
        line-height:48px;
        filter: invert(1);
        color: rgba(var(--normalInverted), .74)
        
    }

    #cards_holder h2{
        margin: 8px 0 !important;
        font-size:24px;
        line-height:26px;
    }
    img.img-card{
        width: 100%;
        height: 200px;
        object-fit:cover;
        border-radius:16px;
    }

    /* .add_padding{padding:48px;} */
    button.landing-button{
        transition:all 500ms cubic-bezier(0.1, 0.8, 0, 1);
    }
    button.landing-button:hover{
        box-shadow: 0px 0px 64px -10px var(--primary);
        transform: translateY(-3px);
    }

    div.content_box.pretty_content{
        padding:64px;
    }

    #holder-landing section{padding:120px 88px;}
    
    div.content_box.img_holder{
    }
    div.content_box.img_holder img{width:100%;}


    @media only screen and (max-width: 680px){
        #holder-landing section{padding:48px 24px;}
        div.content_box.pretty_content{padding:16px;}
        div.content_box.img_holder{border-radius:24px;}
        div.content_box.img_holder img{width:100%; transform: scale(1.2); border-radius:0px; margin-top:24px;}

        /* Titles */
        .title-img{
            height:64px;
            padding:24px;
            border-radius:24px;
            border-radius:32px;
        }
        .title-img h1{
            font-weight:700;
            font-size:48px;
            line-height:48px;
            filter: invert(1);
            color: rgba(var(--normalInverted), .74)  
        }
    }
</style>
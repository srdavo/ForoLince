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
        <?php 
            if(isset($_SESSION["id"])){
                echo "
                    <span class='material-symbols-rounded pretty fill'>login</span>
                    <h2 class='b-margin'>Accede a tu panel de control</h2>
                    <button class='flex-button color-outline ripple_effect' onclick='window.location=\"index\"'>
                        <span class='material-symbols-rounded dynamic fill r-margin'>login</span>
                        Ir a panel de control
                    </button>
                ";
            }else{
                echo "
                    <span class='material-symbols-rounded pretty fill'>person_add</span>
                    <h2 class='b-margin'>Accede o crea una cuenta como estudiante o profesor</h2>
                    <button class='flex-button color-outline ripple_effect' onclick='window.location=\"index\"'>
                        <span class='material-symbols-rounded dynamic fill r-margin'>login</span>
                        Iniciar sesión
                    </button>
                ";
            }
        ?>
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

    <div class="simple-container" style="height:40px">
        <select name="filter-events-date-filte" id="filter-events-date-filter" class="toolbar-select no-reset" onchange="getEventsCards()">
            <option value="all">Mostrar todos los eventos</option>
            <option value="from_today">Mostrar solo eventos pendientes</option>
        </select>
    </div>

    <div class="content_box invisible pretty-content"  id="response-events_holder">
    </div>
    


    
    
</section>

<section id="section-news" style="position:relative">
    <div class="simple-container justify-between grow-1 gap-16 titles-box">
        <h1 class="simple-container gap-8 super-ultra-large emphasized-light bricolage"><md-icon class="dynamic">newspaper</md-icon> Noticias</h1>
        <h2 class="large bricolage">Mantente informado sobre las últimas novedades de la universidad.</h2>
    </div>
    
    <div class="simple-container gap-8 flex-wrap" id="response-news_holder"></div>
    

    

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
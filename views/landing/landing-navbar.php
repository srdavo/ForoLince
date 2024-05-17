    <bottombar class="topbar">
        <div class="navbar_divisor">
            <selector id="btmSel-start" onclick="toggleSection('#section-start')" class="active ripple_effect">
                <span class="material-symbols-rounded">home</span>
                Inicio
            </selector>
            <selector id="btmSel-events" onclick="toggleSection('#section-events');" class="ripple_effect">
                <span class="material-symbols-rounded">event</span>
                Eventos
            </selector>
            <selector id="btmSel-news" onclick="toggleSection('#section-news');" class="ripple_effect">
                <span class="material-symbols-rounded">newspaper</span>
                Noticias
            </selector>
        </div>

        <?php
            if(isset($_SESSION["id"])){
                $permissions_data = $_SESSION["additional_data"]["permissions"];
                switch ($permissions_data) {
                    case '1':
                        echo "
                            <div class='navbar_divisor'>
                                <selector id='btmSel-news' onclick='window.location.href=\"index\"' class='ripple_effect'>
                                    <span class='material-symbols-rounded dynamic fill'>login</span>
                                    Ir a panel de profesor
                                </selector> 
                            </div>
                        ";
                        break;
                    case '7':
                        echo "
                            <div class='navbar_divisor'>
                                <selector id='btmSel-news' onclick='window.location.href=\"index\"' class='ripple_effect'>
                                    <span class='material-symbols-rounded dynamic fill'>login</span>
                                    Ir a panel de administrador
                                </selector> 
                            </div>
                        ";
                        break;
                    
                    default:
                        echo "
                            <div class='navbar_divisor'>
                                <selector id='btmSel-news' onclick='window.location.href=\"index\"' class='ripple_effect'>
                                    <span class='material-symbols-rounded dynamic fill'>login</span>
                                    Ir a panel de estudiante
                                </selector> 
                            </div>
                        ";
                        break;
                }
            }else{
                echo "
                    <div class='navbar_divisor'>
                        <selector id='btmSel-news' onclick='window.location.href=\"index\"' class='ripple_effect'>
                            <span class='material-symbols-rounded dynamic fill'>login</span>
                            Iniciar sesión
                        </selector> 
                    </div>
                ";
            }
        
        ?>
       
        
        
    </bottombar>

    <style>
        selector{
            border-radius:24px;
        }
        .navbar_divisor{
            display:flex;
            flex-grow:1;
            gap:8px;
        }
        .navbar_divisor:last-of-type{
            display:none;
            justify-content: flex-end;
        }
    
        @media only screen and (min-width: 680px){
            .navbar_divisor:last-of-type{display:flex}
            selector{  right:0;}
            bottombar.topbar{
                display:flex !important; 
                position: fixed;
                top:0;
                max-width:100%;
                box-sizing: border-box;
                
                height:80px;
                /* border-radius:16px; */
                padding:24px 88px;

                background: var(--normal);
                /* background: rgba(var(--surfaceLightClear), 0.24); */
                /* background: linear-gradient(180deg, rgba(var(--surfaceLightClear), 0.24) 0%, rgba(255, 255, 255, 0.00) 100%); */
                /* backdrop-filter: blur(240px); */
                /* -webkit-backdrop-filter: blur(64px); */
                /* color: rgba(var(--normalInverted), 0.24); */
            }

            bottombar.topbar selector{
                all:unset;
                display:flex;
                align-items: center;
                gap:8px;
                
                position:relative;
                overflow:hidden;
                
                border-radius:12px;
                padding:0 24px;
                height:40px;
                
                /* background: var(--surfaceMedium); */
                color: rgba(var(--normalInverted), 0.64);

                user-select:none;
                cursor:pointer;
                transition: background 125ms, color 125ms, box-shadow 125ms;
                
                /* background: var(--primary);
                color: var(--onPrimary); */
            }
            bottombar.topbar selector:not(.active):hover{
                background: var(--surfaceMedium);
            }
            bottombar.topbar .navbar_divisor:last-of-type selector:not(.active):last-of-type:hover{
                color: var(--primary);
            }

            bottombar.topbar selector.active {
                background: var(--primary);
                color: var(--onPrimary);
                box-shadow: 0px 0px 32px -10px var(--primary);
            }

            bottombar.topbar selector.active .material-symbols-rounded{
                padding:0;
                background:transparent;
            }
        }

        
    </style>
<header class="header" id="header">
    <span>
        <?= ucfirst($_SESSION['login']) ?>
    </span>

    <div class='d-flex'>
        <a href='../' class='menu'>
            Início
        </a>
        <a href='#' onclick="loading()" class='menu'>
            Importar
        </a>
    </div>
    <a id="logoff" href="../config/logout.php">
        Sair
    </a>
</header>
<script>
    function loading() {
        $("body").css("cursor", "wait")
        $("body *").css("pointer-events", "none")
        
        window.open('../config/importador.php', '_self');
    }
</script>
<style>
    #header{
        background-color: #fff;
        padding: .5rem 2rem;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 5px 5px 15px 5px rgb(0 0 0 / 6%);
    }
    .menu{
        margin: 0 5px;
        text-decoration: none;
        color: #fff;
        border-radius: 4px;
        padding: 3px 15px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        background-color: #274259;
        font-family: monospace
    }
    .menu:hover{
        background-color: #274259cc;
        color: #fff;
    }
    #logoff{
        text-decoration: none;
        color: #fff;
        border-radius: 4px;
        padding: 3px 15px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        background-color: #274259;
        font-family: monospace
    }
    #logoff:hover{
        background-color: #f00;
    }
</style>
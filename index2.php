<?php
session_start();
include("inc/connADODB.php");
include("inc/const.php");
include("inc/function.php");
include("inc/gestione_mail.php");

$stile1 = "block";
$stile2 = "none";
$maxacc = 3;
if (isset($_SESSION["my_user"])) {
    header("Location: gestione/index.php");
} elseif (isset($_SESSION["count"]) && $_SESSION["count"] > $maxacc) {
    //$msg = "<p>Troppi tentativi di accesso</p>";
} elseif (isset($_SESSION["errtype"]) && $_SESSION["errtype"] == "blocco") {
    $msg = "L'utente selezionato risulta gi&agrave; connesso da un'altra postazione, se si desidera sbloccare la connessione esistente autenticarsi e fare click sul pulsante sottostante:";
} elseif (isset($_SESSION["errtype"]) && $_SESSION["errtype"] == "errorelic") {
    $msg = "Si &eacute; verificato un errore di accesso.<br />Codice errore: LXFB.<br />Contattare <a href=\"http://www.lucense.it\">Lucense</a> per assistenza.";
} elseif (!empty($_POST["username"]) && $_POST["azione"] = "RP") {
    // recupero password
    $_SESSION["count"] = 0;
    $query = "select id_utente, email, descrizione from sic_utenti where attivo = 1 and uid = '" . encode_string_web($_REQUEST["username"]) . "'";
    $row = $db->Execute($query) or die("Errore nella query: $query");
    if ($row->EOF) {
        $msgrp = "<p class=\"error\">Nome utente non valido.</p>";
        $stile1 = "none";
        $stile2 = "block";
    } else {
        $newpwd = chr(rand(69, 90)) . chr(rand(97, 122)) . rand(0, 9) . chr(rand(69, 90)) . chr(rand(97, 122)) . rand(0, 9);
        $query = "Update sic_utenti set pwd = '" . md5($newpwd) . "', dt_decorrenza_pwd = CURDATE() where id_utente = '" . intval($row->fields["id_utente"]) . "'";
        $db->Execute($query) or die("Errore nella query: $query");
        $corpo = "<p>Gentile {$row->fields["descrizione"]},<br />la procedura di recupero password &egrave; avvenuta con successo.</p><p>La Vostra nuova password di accesso &egrave; <strong>$newpwd</strong>.</p><p>Si consiglia di cambiare la password fornita al primo accesso tramite l'apposita funzione raggiungibile dal menu Sicurezza nella barra di intestazione.</p>";
        invioMail($row->fields["email"], "Recupero password di accesso", $corpo);
        $msg = "Una nuova password di accesso &egrave; stata spedita all'indirizzo " . $row->fields["email"];
    }
    $row->close();
} elseif (isset($_SESSION['count']) && $_SESSION['count'] > 0) {
    $msg = "Tentativo n&deg;" . $_SESSION['count'] . ", utente o password errati.";
    if (intval($_SESSION['count']) == $maxacc)
        $msg .= "<span style=\"font-size:80%\"><br />Vi rimane un ultimo tentativo di accesso, dopodich&eacute; non sar&agrave; pi&ugrave; possibile autenticarsi da questo pc. Nel dubbio utilizzare la funzionalit&agrave; di recupera password in basso a destra.</span>";
    else
        $msg = "<p>$msg</p>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <?php include("inc/AR_meta.php"); ?>
        <title><?php echo NOMESITO ?></title>
        <!--<link rel="icon" type="image/gif" href="/img/favicon_ani.gif" />-->
        <style type="text/css">
            body, h1, div, form, h2 { border:0 none;  margin:0;  padding:0; }
            body { background: #fff url(img/struttura/sfondopallini.png) no-repeat top left; font:1.2em "Trebuchet MS", Arial, Helvetica, sans-serif; color:#0c3183; }
            a { color:#39F;  text-decoration:none }
            a:hover { text-decoration:underline }
            #frame { width:955px;  margin:0 auto; position:relative }
            #frame #intestazione { height:137px; }
            #frame #intestazione #logo {height:230px; width:200px; background:url(img/struttura/sfondologo.png) no-repeat top left; margin-top:137px; float:left; text-align:center}
            #frame #intestazione #logo img{border:0px solid #ddd;}
            #frame #intestazione h1 { position:absolute; top:40px; left:30px; z-index:5; display:none}
            #frame #intestazione .error {color:#FF0000;left:227px;position:absolute;text-align:center;top:30px;width:496px;z-index:6;}
            #frame #content {width:500px; margin:0 auto; position:relative}
            #frame #content h2{ text-align:right; padding-right:15px}
            #frame #content .login { padding:45px 15px 3px 60px; background:url(img/struttura/sfondologin.png) no-repeat top left; width:425px; height:170px}
            #frame #content .login h2 {border-bottom:1px dotted #ccc}
            #frame #content .login label { color:#0C3183; display:block; width:120px; float:left;text-align:right; padding-right:20px}
            #frame #content .login p {margin:0; padding:10px 15px}
            #frame #content .login input {border:1px solid #ccc;}
            #frame #content .login input.uno {width:200px}
            #frame #content .login input.pulsante {padding:2px 5px; background-color: #526063; color:#fff; -moz-border-radius:6px; border-radius:6px; -webkit-border-radius:6px}
            #frame #content .login .error { color:#FF0000; font-size:80%; font-weight:bold; text-align:center; margin-right:40px}
            #frame #content .login .angolo {text-align:right; font-size:50%; bottom:25px;font-size:50%;position:absolute;right:15px;text-align:right}
        </style>
    </head>
    <body>
        <div id="frame">
            <div id="intestazione"><div id="logo"><img src="img/struttura/<?php echo getconst("logo_azienda_home") ?>" /></div><h1><img src="img/struttura/logomemo_b_ani.gif"/></h1> <?php if (isset($msg)) echo "<div class=\"error\">{$msg}</div>"; ?></div>
            <div id="content">
                <div class="login">
                    <?php
                    if (isset($_SESSION["count"]) && $_SESSION["count"] > $maxacc) {
                        echo "<div class=\"error\"><p>Troppi tentativi di accesso.</p></div>";
                    } else {
                        if (isset($_SESSION['errtype']) && $_SESSION['errtype'] == "blocco") {
                            $query = "Select uid from sic_utenti where md5(id_utente) = '" . $_SESSION['idlogin'] . "'";
                            $rs = $db->execute($query) or die("Errore nella query: $query");
                            $uid = $rs->fields["uid"];
                            $rs->close();
                        } elseif (!empty($_SESSION["loguid"]))
                            $uid = $_SESSION["loguid"];
                        ?>
                        <div id="login-accesso">
                            <form name="sblocca" method="post" action="gestione/accedi.php">
                                <p><label for="uid">Nome Utente</label> <input type="text" name="uid" id="uid" class="uno" value="<?php if (isset($uid)) echo $uid ?>" /></p>
                                <p><label for="pwd">Password</label> <input type="password" name="pwd" id="pwd" class="uno" /></p>
                                <?php if (isset($_SESSION['errtype']) && $_SESSION['errtype'] == "blocco") { ?>
                                    <p><input type="submit" name="azione" value="Annulla" /> <input type="submit" name="azione" value="Sbloccare la connessione esistente" onclick="return confirm('Si conferma l\'operazione di sblocco?')" /></p>
                                <?php } else { ?>
                                    <p><label>&nbsp;</label><input type="submit" value="Accedi" class="pulsante" />
                                    </p>
                                <?php } ?>
                            </form>
                            <div class="angolo"><a href="#" onclick="$('#login-accesso').toggle(); $('#login-pwd').toggle()">Password dimenticata?</a></div>
                        </div>
                        <div id="login-pwd" style="display:<?php echo $stile2 ?>">
                            <form name="recupera" action="" method="post" onsubmit="return controlla();">
                                <input type="hidden" name="azione" id="azione" value="RP" />
                                <p>
                                    Inserisci il nome utente<br />
                                    <input type="text" name="username" id="username" /><br />
                                    <span style="font-size:60%">Una nuova password di accesso verr&agrave; creata ed inviata all'indirizzo email associato.</span><br />
                                    <label>&nbsp;</label><input type="submit" value="Recupera password" class="pulsante" />
                                </p>
                            </form><div class="angolo"><a href="#" onclick="$('#login-accesso').toggle(); $('#login-pwd').toggle()">Annulla</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 6") or strstr($_SERVER['HTTP_USER_AGENT'], "MSIE 5")) { ?>
                <div style="border:4px solid #F96; width:55%; margin:0 auto; padding:5px 10px; position:absolute; top:30%; left:21%; background:#FFF3CA; text-align:center">
                    <p style="margin:0; padding:0"><strong>Attenzione!</strong><br />
                        MeMO richiede una versione superiore di Internet Explorer.
                        Scaricare <a href="http://www.microsoft.com/windows/Internet-explorer/">Internet Explorer 7 o 8</a>.<br />
                        Nel caso in cui si stia gi&agrave; utilizzando il browser Internet Explorer 8, accertarsi che la &quot;Visualizzazione compatibilit&agrave;&quot; sia disattivata, cliccando sull'icona evidenziata.<br />
                        <img src="img/compatibility_mode.jpg" alt="clicca sull'icona: Visualizzazione Compatibilit&agrave;" />
                    </p>
                </div>
            <?php } ?>
            <div style="text-align:center; font-size:50%; padding-top:45px">&copy;2010 <a href="http://www.lucense.it">LUCENSE</a></div>
        </div>
        <script type="text/javascript" src="/obj/jquery.min.js"></script>
        <script type="text/javascript">
            <!--
            function controlla(){
                if (document.getElementById("username").value == "") {
                    alert("Inserire il nome utente");
                    return false;
                }
                return true;
            }
            //-->
        </script>
    </body>
</html>
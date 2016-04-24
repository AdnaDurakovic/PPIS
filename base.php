<?php
/**
 * Created by PhpStorm.
 * User: Adna
 * Date: 29/03/2016
 * Time: 17:56
 */
function Greska ($s, $e = false)
{
    /*
    header("Refresh:0; url=index.php");
    echo '<script language="javascript">';
    echo 'alert("'.$s.'")';
    echo '</script>';
    */
    echo "<h1>$s</h1>";
    if ($e)
        exit();
}

function Success ($s, $e = false, $i = 2)
{
    /*
    header("Refresh:0; url=http://aiee.co.nr");
    echo '<script language="javascript">';
    echo 'alert("'.$s.'")';
    echo '</script>';
    */
    echo "<h1>$s</h1>";
    if ($e)
        exit();

}

function InitBase()
{
    $dbname = "fabrikawood";
    $servername = "localhost";
    $username = "ppis";
    $password = "ppis";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->exec("set names utf8");
    }
    catch(PDOException $e)
    {
        Greska($e, false);
        throw $e;
    }

    unset ($dbname);
    unset ($servername);
    return $conn;
}

function Sesija ()
{
    global $sesija_time;
    $sesija = false;
    session_start();
    if (isset($_SESSION['sesija']) && (time() - $_SESSION['sesija'] > $sesija_time)) #15 min sesija
    {
        $sesija = isset ($_SESSION['user']) && $_SESSION['user'] !== "" ? true : false;
        session_unset();
        session_destroy();
        session_start();
    }
    $_SESSION['sesija'] = time();
    $user = "";
    $ime = "";
    $logovan = false;

    if (isset ($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $logovan = true;
        $ime = $_SESSION['ime'];
    }
    return array($user, $logovan, $ime, $sesija);
}


function ProcessError (PDO $e)
{
    $greska = $e->errorInfo();
    print "<h1 style='color:red;'>SQL greška: <i>" . $greska[0] . "</i></h1>";
    exit();
}


function Korisnik ($user)
{
    $X = InitBase();
    $p = $X->prepare("SELECT Username, Password FROM menadzeri WHERE Username = :u");
    $p->bindParam(":u", $user, PDO::PARAM_STR);
    $p->execute();
    if (!$p)
        ProcessError($X);
    $rr = $p->fetch();
    $ok = !$rr ? false : count($rr) > 0;
    $pass = $rr['Password'];
    return array($ok,  $pass);
}
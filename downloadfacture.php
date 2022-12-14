<?php 
session_start();
ob_start();
// $_SESSION['user']=[
//     "Nom"=> $Nom,
//     "Prenom" => $Prenom,
//     "email"=> $Email,
//     "age"=>$Age,
//     "sexe"=>$Sexe,
// ];
$nomDuClient=$_SESSION['user']['lastname'];
$prenomDuClient=$_SESSION['user']['firstname']; 
$numeroDeTelDuClient=$_SESSION['user']['email'];
$date = "Facturé le " . date("d/m/Y") ;
$facture="Facture n°". (rand(1, 10000) . "<br>");
$prix="5€";
$daterdv="a voir";
?>
<style>
 .premiertable{width: 100%; }
 .deuxiemetable{width: 100%; }
.client{  text-align:center;width: 100%;}
.date{ text-align:center; width: 100%;}
.styleEcriture{font-size: large;border: 1px solid black;}
.bordureEntreprise{border:solid 1px black ; width:50%;text-align:center}
.bordureClientUne{ width:50%; }
.BordureDeux{border:solid 1px black ; width:50%; }
.imgtest{text-align:center;}
.footer{font-style: italic;}
.page{
    padding-top: 5px;
}

</style>

<page class="page" backimg="img/Logoo.jpg" backimgx="90%" backimgy="10%" backimgw="25%" backtop="20mm" backleft="10mm" backright="10mm" >
    
    <table class="premiertable" >
        <tr>
            <td >
                <div class="bordureEntreprise">
            <p class="styleEcriture">
                
            <b>Identifcation du prestataire</b><br><br>
            <strong>Nom</strong>: Audomavoix<br>
            <strong>Adresse</strong>: 160, rue de Lalorem – 62001 Loremville <br>
            <strong>Numéro de SIREN</strong>: 833429999<br>
            <strong>Numéro de téléphone</strong>:0321232529<br>
            Enregistré au RCS/RM de Lorem</p>
            </div>
            </td>
            </tr>
            <tr class=>
                <td class="client"  >
                    
                <div class="bordureClientUne">
                <div class="BordureDeux">
                <p class="styleEcriture"><b>Facturé à :</b><br><br>
                <?php echo $nomDuClient ;?><br>
                <?php echo $prenomDuClient ;?><br />
                <?php echo $numeroDeTelDuClient ;?>
                </p>
                </div>
                </div>
                </td>
            </tr>
    </table>
    <table class="deuxiemetable">
        <tr>
        <td class="date">
        <br><br><br><br>
            <p class=" styleEcriture"><strong><?php echo $facture ?></strong></p>
             <p class=" styleEcriture"><?php echo $date ?></p>
             <br><br><br><br><br>
         </td>
        </tr>
        <tr>
            <td style="text-align:center; margin-top:10px;">
                Nous vous confirmons la réception de votre paiement d'un montant de <?php echo $prix ?>.<br><br>
                Nous vous invitons a vous présentez le <?php echo $daterdv ?> pour votre prestation.<br><br>
                Veuillez recevoir l'assurance de ma considération distinguée.<br><br>
                Audomavoix <br><br><br><br>
            </td>
        </tr>
        <tr><td>
            <div class="imgtest">
            
            </div>
        </td></tr>
    </table>
    <page_footer > 
    <p class="footer">
        Audomavoix, SAS au capital de 2€<br>
        160, rue de Lalorem – 62001 Loremville<br>
        Immatriculé au RCS de Lorem sous le numéro RCS Lorem B 666 555 201<br>
        TVA intracommunautaire : FR 53 046785231
    </p>
    </page_footer>
</page>

    
  


<?php
$content=ob_get_clean();
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
try{
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('facture.pdf','D');
    
}catch(Html2PdfException $e){
    die($e);
}



?> 
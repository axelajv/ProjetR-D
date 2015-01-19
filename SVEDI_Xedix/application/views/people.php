<?php

   $connect_array=array();
   
   $serveur="http://localhost:5290" ;

   $connect_array = xedix_connect ( $serveur ) ;
   $cleSession = $connect_array[1];


# Requetage

#    $requete='french <dans> langue';
#    $requete='2007.* <dans> numero_carte';
#    $requete='etudiant/statut <$seq(R)> ';
#    $requete='date_naissance <$dle(d01m01y1990)>';
     $requete='john';
   

# On encode la requete pour la passer en argument

   $requete_url=my_encode2($requete) ;
#   print "Requete_URL=".$requete_url ;
   
 # Selection

   #   $select1='<all|0>;etudiant<all|32>;prenom<all|1>;nom<all|1>' ;
   $select1='<all|0>;people<-1|16||>;person<-1|16||>;address<-1|16||>;country<-1|1||>;';

#  $select='';

# On encode la selection pour la passer en argument

   $select_url=my_encode2($select1);

# On envoie l'appel regroupant requete+selection a XediX

   $flux = xedix_send ($connect_array[0],$serveur,$cleSession,$requete_url,$select_url) ;


   $nbmots =str_word_count ($flux,0);
   
   $mots = str_word_count ($flux,1 );
    

   for ( $i=0 ; $i <= $nbmots/2 ; $i ++ ) {
 	
        $prenom[$i+1]=$mots[2*$i+1];
        $nom[$i+1]=$mots[2*$i];
   }


   print "<HTML><HEAD><TITLE>Tous les marks</TITLE></HEAD><BODY><h1>Les marks dans people</h1><OL>" ;

   for ( $i=1 ; $i <= $nbmots/2 ; $i++ ) {
   
#  	 print $i." ".$prenom[$i]." ".$nom[$i]."\n" ;
         print "<LI> ".$prenom[$i]." ".$nom[$i]."</LI>";

   }

   print "</ol></body></html>";
   



# Deconnexion de la base

  xedix_disconnect($connect_array[0]) ;

#
#
#   Fonctions
#
#
#
  
function tagextract ($tag,$f) {
	
   $tago="<".$tag.">" ;
   $tagf="</".$tag.">" ;
   $temp=explode($tago,$f);
   $temp1=$temp[1];
   $temp2=explode($tagf,$temp1);
   return $temp2[0];
}

function xedix_connect ( $serveur ) {

#  Identification de l'utilisateur

   $login='admin' ;
   $password=rawurlencode('xedix#amodifier') ;
   $c='';

#  Ouverture de la session

   $fi=fopen($serveur.'/cgi-bin/client?X2Admin+13++login='.$login.'&pwd='.$password.'&output=xml', 'r');

   if ( $fi == 0 ) {

        echo 'Connexion impossible' ;
        exit (1) ;

   }

   while(!feof($fi)){
       $c .= fread($fi, 4096);
       }

# Extraction de la valeur de la cle de session

    $cleSession=tagextract("clefsession",$c) ;
    $retour=array();
    $retour[0]=$fi ;
    $retour[1]= $cleSession ;
    return  $retour ;

}

function xedix_send ($fr,$serveur,$cleSession,$requete_url,$select_url) {

    $cc='';
    $fr=fopen($serveur."/cgi-bin/client?X2Xsearch+7+admin,".$cleSession."+allrequest=".$requete_url."&elems=".$select_url."&output=xml&targetcoll=listepropre&high=no&display=simple",'r');

   if ( $fr == 0 ) {

        echo "L'envoi de donnees a echoue" ;
        exit (1) ;

   }

   while(!feof($fr)){
        $cc .= fread($fr, 4096);
   }

# Nettoyage du flux XML


    $flux=tagextract("xedixlisteetendue",$cc);

    return $flux;

}


function xedix_disconnect ($fr) {

	fclose($fr) ;
	return ;
	
}

function my_encode ( $chaine ) {

	$temp=rawurlencode($chaine);
	$temp1=str_replace("%2F","/",$temp);

	$temp2=str_replace("%28","(",$temp1);

	$temp3=str_replace("%29",")",$temp2);

	return $temp3 ;
}

function my_encode2 ( $chaine ) {

	$temp1=str_replace("&","%26",$chaine);

	$temp2=str_replace("=","%3D",$temp1);

	$temp3=str_replace(" ","%20",$temp2);

	return $temp3 ;
}

?>



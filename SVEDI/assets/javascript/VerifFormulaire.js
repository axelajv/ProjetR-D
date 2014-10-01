function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "white";
}

function verifNom(champ)
{
	
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifPrenom(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function verifTel(champ)
{
    var regex = /^0[1-689][0-9]{8}$/;
	
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function verifForm(f)
{

	var NomOk = verifNom(f.Nom);

   var PrenomOk = verifPrenom(f.Prenom);

   var MailOk = verifMail(f.Mail);

   var TelOk = verifTel(f.Tel);

  
   if(NomOk && PrenomOk && MailOk && TelOk){
		alert("ValiderDp");
		return true;
	}  
   else
   {
		alert("Veuillez remplir correctement tous les champs");
		return false;
   }
   
}

//-------------------------------------------------------------------
//--------------Modification Mdp-------------------------------------
//-------------------------------------------------------------------

function verifAncienMDP(champ,mdp)
{

//if(champ.value.length < 6 || champ.value.length > 25) 
   if( champ.value != mdp) 
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
   
}


function verifMDP(champ)
{
   if(champ.value.length < 6 || champ.value.length > 25)  
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
   
}
 
function verifSimilitudeMdp(f,mdp)
{

	var AMdpOk = verifAncienMDP(f.AMdp,mdp);

   var Mdp1Ok = verifMDP(f.Mdp1);

   var Mdp2Ok = verifMDP(f.Mdp2);
 
   alert(f.Mdp1.value);
   alert(f.Mdp2.value);

   if(AMdpOk && Mdp1Ok &&  Mdp2Ok && f.Mdp1.value==f.Mdp2.value ){
		alert("Validermdp");
		return true;
	}  
   else
   {
		alert("Veuillez remplir correctement tous les champs");
		return false;
   }
   
}
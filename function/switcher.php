<?php

// Rayons
//$rayone = $row['IDRAY'];
function switch_rayon($rayon)
{
    // echo '</br>';
    // echo 'Correspondance Catégorie Racine Presta : '; 
        switch ($rayon) {
            
            case 2:
            // echo "Accessoires";
            return 9;
      
            case 3:
            // echo "Chaussures";
            return 6;
                        
            case 8:
            // echo "Vêtements"; 
            return 3;
                        
            case 1:
            // echo "Sweat/Vetements";    
            return 3;
                    
            case 5:
            // echo "Calecon/Accessoires ";   
            return 9;
                
            default : return 57;
            }

}
 

// Categories
function switch_cat($categorie){
//$categorie = $row['IDFAM'];
//  echo '</br>';
//  echo 'Correspondante Catégorie Presta : '; 
        switch ($categorie) {

            case -1: //id Kezia Manque la famille
            return 57; // id presta 
    
            case 0://Manque la famille
            return 57;

        	case 1: //pantalon
            // echo 'Pantalon';
        	return 10;
            break;

        	case 2: // short
            // echo 'Short';
        	return 33;
            break;
            
            case 3: // Chaussures/racine
            // echo 'Chaussures/Racine';
            return 6;
        	break;
            
            case 4: // t-shirt
            // echo 'T-shirt';
            return 12;
            break;
            
            case 5: // Calecon/racine (a supprimer en double)
            // echo 'Calecon/Racine';
            return 55;
                     
            case 6: // Sweat
            // echo 'Sweat';
            return 11;
      
            case 7: // Chaussures a supprimmer
            // echo 'Chaussures à Supr';
            return 6;
        
            case 8: // Casquettes
            // echo 'Casquettes';
            return 27;
        
            case 9: // Vestes
            // echo "Vestes";
            return 36;
          
            case 10: // xxxx
            // echo "xxxx Sweat 2";
            return 11;
          
            case 11: // Chaussettes
            // echo 'Chausettes';
            return 15;
            
            case 16: // Ceintures
            // echo 'Ceintures';
            return 14;
         
            case 17: // Bonnets
            // echo 'Bonnets';
            return 25;
            break;

            case 18: // Baggagerie
            // echo "Baggages";
            return 30;
            break;

            case 19: // Chaussures /Hommes
            // echo "Chaussures Hommes";
            return 50;
          
            case 20: // Chaussures /Femmes
            // echo "Chaussures Femmes";
            return 51;
            
            case 21: // Chaussures /Enfants
            // echo "Chaussures Enfants";
            return 52;
            
            case 23: // Chemises 
            // echo "Chemises";
            return 37;

            case 24: // UNDERWEAR 
                // echo "Underwear";
            return 55;

            case 25: // Claquettes
            // echo "Claquettes"; 
            return 22;

            case 26: //survetement
            // echo 'Survetement';
            return 35;
            
            case 33: // Pull 
            // echo "Pull";
            return 49;

            case 34: // Debardeur 
                // echo "Debardeur";
            return 34;

            case 35: // Bob 
                // echo "Bob";
                return 58;

            case 36: // Polo 
                //  echo "Polo";
                 return 32;

            case 37: // Jouets
                    return 59;    
            
            default : return 0;
        }
    
}


function switch_couleur($couleur) 
{
     switch ($couleur) {
        case 1: 
        // echo 'Noir : ';
        return 11;
                
        case 2: 
        // echo 'Blanc : ';
        return 8;
                
        case 3: 
        // echo 'Bleu : ';
        return 14; 
                
        case 4: 
        // echo 'Rouge : ';
        return 10;
               
        case 5: 
        // echo 'Gris : ';
        return 5;
               
        case 6: 
        // echo 'Vert : ';
        return 15;
       
        case 7: 
        // echo 'Jaune : ';
        return 16;
               
        case 8: 
        // echo 'Rose : ';
        return 18;
               
        case 9: 
        // echo 'Beige : ';
        return 7;
               
        case 10: 
        // echo 'Orange : ';
        return 13;
               
        case 11: 
        // echo 'Violet : ';
        return 46;
              
        case 12: 
        // echo 'Kaki : ';
        return 47;
           
        case 13: 
        // echo 'Brun : ';
        return 12;
    
        case 14: 
        // echo 'Bordeaux : ';
        return 48;
       
        case 15:
        // echo 'MultiColor : ';
        return 49;
                
        case 16:
        // echo 'Marron : ';
        return 17;
          
        case 17:
        // echo 'Fluo : ';
        return 50;
               
        case 18:
        // echo 'Camo : ';
        return 51;
            
        case 19:
        // echo 'Gris chine : ';
        return 52;
            
        case 20:
        // echo 'Navy : ';
        return 53;
        
        case 21:
        // echo 'Denim : ';
        return 93;

        default : 
        echo '<strong>Pas de couleur</strong> <br>';       
        return 0; //noir par default 
       }
}


function switch_taille($taille){

//Tailles 
  // $taille = $row['IDTAILLE']; 
switch ($taille) {

    case 1: 
    // echo 'XS ';
    return 31;
 
    case 2: 
    // echo 'S ';
    return 1;
  
    case 3: 
    // echo 'M ';
    return 2;

    case 4: 
    // echo 'L ';
    return 3;

    case 5: 
    // echo 'XL ';
    return 4;
    
    case 6: 
    // echo 'XXL';
    return 32; 

    case 7: 
    // echo '36';
    return 27;

    case 17: 
    // echo '36.5';
    return 54;
    
    case 18: 
    // echo '37';
    return 28;
    
    case 19: 
    // echo '37.5';
    return 55;
    
    case 20: 
    // echo '38';
    return 29;
    
    case 21: 
    // echo '38.5';
    return 56;

    case 22: 
    // echo '39';
    return 30;
    
    case 23: 
    // echo '39.5';
    return 57;

    case 24: 
    // echo '40';
    return 33;
        
    case 25: 
    // echo '40.5';
    return 58;
        
    case 26: 
    // echo '41';
    return 34;
    
    case 27: 
    // echo '41.5';
    return 59;
    
    case 28: 
    // echo '42';
    return 35;

    case 29: 
    // echo '42.5';
    return 60;

    case 30: 
    // echo '43';
    return 36;

    case 31: 
    // echo '43.5';
    return 61;
    
    case 32: 
    // echo '44';
    return 37;

    case 33: 
    // echo '44.5';
    return 62;

    case 34: 
    // echo '45';
    return 39;

    case 35:
    // echo '45.5';
    return 63;

    case 36:
    // echo '46';
    return 38;

    case 37:
    // echo 'XXS';
    return 72;

    case 38:
    // echo '28/32';
    return 64;

    case 39:
    // echo '29/32';
    return 65;

    case 40:
    // echo '30/32';
    return 66;

    case 41:
    // echo '31/32';
    return 67;

    case 42:
    // echo '32/32';
    return 68;

    case 43:
    // echo '32/34'; 
    return 69;

    case 44:
    // echo '34/34';
    return 70;

    case 45:
    // echo '36/34';
    return 71;

    case 46:
    // echo '35';
    return 26;

    case 47:
    // echo '30/34';
    return 89;

    case 48:
    // echo '33/32';
    return 88;

    case 49:
    // echo '34/32';
    return 90;
    
    case 50:
    // echo '36/32';
    return 91;

    case 51:
    // echo '28';
    return 73;

    case 52:
    // echo '28.5';
    return 74;

    case 53:
    // echo '29';
    return 75;

    case 54:
    // echo '29.5';
    return 76;

    case 55:
    // echo '30';
    return 77;

    case 56:
    // echo '30.5';
    return 78;

    case 57:
    // echo '31';
    return 79;

    case 58:
    // echo '31.5';
    return 80;    

    case 59:
    // echo '32';
    return 81;

    case 60:
    // echo '32.5';
    return 82;

    case 61:
    // echo '33';
    return 83;

    case 62:
    // echo '33.5';
    return 84;

    case 63:
    // echo '34';
    return 85;

    case 64:
    // echo '34.5';
    return 86;

    case 65:
    // echo 'OS';
    return 92;
    
    default : 
    // echo 'Pas de Taille : OS par défault<br>';
    return 92; //OS par default 
 }


}





?>
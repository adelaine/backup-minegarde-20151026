<?php

/*Permuation function to find the material
>_> does a lot of stuff. When 4 material are set, there are 4*3*2*1 things
to check...*/
function zpermute($matSet, $material, $prevStatSet)
{
   $query = '';
  switch($matSet)
  {

    case 1:

    if($prevStatSet == true)
       $query.=" AND ";
    else
       $query.=" WHERE ";

       $query.=" `Material1` = '$material[0]' or `Material2` = '$material[0]' or `Material3` = '$material[0]'";
       $query.=" or `Material4` = '$material[0]' ";
       $prevStatSet = true;

    break;
   
    case 2:
   
       if($prevStatSet == true)
          $query.=" AND ";
       else
          $query.=" WHERE ";

         $did = false; 
         for( $i=1; $i <= 4; $i++){
            for( $j=1; $j <= 4; $j++)
            {
              if($j != $i){
                  if($did == true)
                     $query.=" or ";

                  $query.=" (`Material$i` = '$material[0]' AND `Material$j` = '$material[1]') "; 
                  $did = true;
               }
            }
         }
    break;

    case 3:
   
       if($prevStatSet == true)
          $query.=" AND ";
       else
          $query.=" WHERE ";

         $did = false; 
         for( $i=1; $i <= 4; $i++){
            for( $j=1; $j <= 4; $j++)
               for( $k=1; $k <= 4; $k++)
               {
                     if($k != $j && $k != $i && $i != $j){
                        if($did == true)
                           $query.=" or ";

                        $query.=" ( `Material$i` = '$material[0]' AND `Material$j` = '$material[1]' AND `Material$k` = '$material[2]') "; 

                           $did = true;
                     }
               }
         }
    break;

    case 4:
/*{i,j} {i,k} {i,l} {j,k} {j,l} {k,l}*/
       if($prevStatSet == true)
          $query.=" AND ";
       else
          $query.=" WHERE ";

         $did = false; 
      
       for( $i=1; $i <= 4; $i++)
            for($j=1; $j<= 4; $j++)
               for($k=1; $k <= 4; $k++)
                  for($l=1; $l <= 4; $l++)
                  {
                     if($i != $j && $i != $k && $i != $l && $j != $k && $j != $l && $k != $l){
                        
                        if($did == true)
                           $query.=" or ";

                           $query.=" ( `Material$i` = '$material[0]' AND `Material$j` = '$material[1]' AND `Material$k` = '$material[2]' ";
                           $query.=" AND  `Material$l` =  '$material[3]' ) ";

                           $did = true;
                     }
                  }
    break;
  }
   return $query;
}



function printMatOption()
{
?>

<option value="Any">Any</option>
<option value="Akantor Claw">Akantor Claw</option>
<option value="Akantor Scale">Akantor Scale</option>
<option value="Akantor Shell">Akantor Shell</option>
<option value="Akantor Spike">Akantor Spike</option>

<option value="Akito Jewel">Akito Jewel</option>
<option value="Alluring Hide">Alluring Hide</option>
<option value="Alluring Webbing">Alluring Webbing</option>
<option value="Ancient Potion">Ancient Potion</option>
<option value="AncientDrgnmoss">AncientDrgnmoss</option>
<option value="Anteka Antlers">Anteka Antlers</option>
<option value="Antiseptic Stone">Antiseptic Stone</option>
<option value="Armor Pill">Armor Pill</option>
<option value="Azure LaoS Claw">Azure LaoS Claw</option>

<option value="Azure LaoS Shell">Azure LaoS Shell</option>
<option value="Azure LaosS Horn">Azure LaosS Horn</option>
<option value="Azure Rthlos Cpc">Azure Rthlos Cpc</option>
<option value="Basarios Carpace">Basarios Carpace</option>
<option value="Basarios Shell">Basarios Shell</option>
<option value="Basarios Wings">Basarios Wings</option>
<option value="BattlefieldJewel">BattlefieldJewel</option>
<option value="Big Wyvern Stone">Big Wyvern Stone</option>
<option value="Binoculars">Binoculars</option>

<option value="Bitterbug">Bitterbug</option>
<option value="Black Blos Cpc">Black Blos Cpc</option>
<option value="Black Blos Tail">Black Blos Tail</option>
<option value="Black Narga Pelt">Black Narga Pelt</option>
<option value="Black Pearl">Black Pearl</option>
<option value="BlackbeltCoinG">BlackbeltCoinG</option>
<option value="BlackNargaPelt+">BlackNargaPelt+</option>
<option value="Blango Pelt ">Blango Pelt </option>
<option value="Blangonga Fang">Blangonga Fang</option>

<option value="Blangonga Pelt">Blangonga Pelt</option>
<option value="Blangonga Tail">Blangonga Tail</option>
<option value="Blangonga Whiskr">Blangonga Whiskr</option>
<option value="Blk Gravios Cpc">Blk Gravios Cpc</option>
<option value="Blk Gravios Shl">Blk Gravios Shl</option>
<option value="Blk Gravios Skl">Blk Gravios Skl</option>
<option value="Blk Rajang Pelt">Blk Rajang Pelt</option>
<option value="Blk Rajang Pelt+">Blk Rajang Pelt+</option>
<option value="Blood Red Horn">Blood Red Horn</option>

<option value="Blue Kut-Ku Shl">Blue Kut-Ku Shl</option>
<option value="Book of Combos 1">Book of Combos 1</option>
<option value="Boomerang">Boomerang</option>
<option value="Bughopper">Bughopper</option>
<option value="Bulldrome Hide">Bulldrome Hide</option>
<option value="Bullfango Pelt">Bullfango Pelt</option>
<option value="Burnt Meat">Burnt Meat</option>
<option value="C.BlangongaPelt+">C.BlangongaPelt+</option>
<option value="Cactus Flower">Cactus Flower</option>

<option value="Catalyst">Catalyst</option>
<option value="Ceanataur Claw">Ceanataur Claw</option>
<option value="Ceanataur Claw+">Ceanataur Claw+</option>
<option value="Ceanataur Pincer">Ceanataur Pincer</option>
<option value="Cephalos Fin">Cephalos Fin</option>
<option value="Cephalos Scale">Cephalos Scale</option>
<option value="Chameleos Claw">Chameleos Claw</option>
<option value="Chameleos Hide">Chameleos Hide</option>
<option value="Chameleos Hide+">Chameleos Hide+</option>

<option value="Chameleos Jewel">Chameleos Jewel</option>
<option value="Chaos Mushroom">Chaos Mushroom</option>
<option value="CloseRngCoating">CloseRngCoating</option>
<option value="Clust S Lv3">Clust S Lv3</option>
<option value="Commendation">Commendation</option>
<option value="Commendation G">Commendation G</option>
<option value="Comrade Ticket">Comrade Ticket</option>
<option value="Conga Pelt">Conga Pelt</option>
<option value="Conga Pelt+">Conga Pelt+</option>

<option value="Congalala Claw">Congalala Claw</option>
<option value="Congalala Fang">Congalala Fang</option>
<option value="Congalala Pelt">Congalala Pelt</option>
<option value="Congalala Pelt+">Congalala Pelt+</option>
<option value="Coral Cphlos Fin">Coral Cphlos Fin</option>
<option value="Crag S Lv3">Crag S Lv3</option>
<option value="Cricket">Cricket</option>
<option value="Daora Carapace">Daora Carapace</option>
<option value="Daora Claw">Daora Claw</option>

<option value="Daora Horn">Daora Horn</option>
<option value="Daora Jewel">Daora Jewel</option>
<option value="Daora Sharp Claw">Daora Sharp Claw</option>
<option value="Daora Tail">Daora Tail</option>
<option value="DaoraDragonScal+">DaoraDragonScal+</option>
<option value="DaoraDragonScale">DaoraDragonScale</option>
<option value="Dark Piece">Dark Piece</option>
<option value="Dark Stone">Dark Stone</option>
<option value="DeadlyPoisonSac">DeadlyPoisonSac</option>

<option value="Demondrug">Demondrug</option>
<option value="Diablos Carapace">Diablos Carapace</option>
<option value="Diablos Shell">Diablos Shell</option>
<option value="Dosbiscus">Dosbiscus</option>
<option value="Dragon S">Dragon S</option>
<option value="Dragon Seed">Dragon Seed</option>
<option value="Dragonite Ore">Dragonite Ore</option>
<option value="Dragonmoss">Dragonmoss</option>
<option value="Dragonwood+">Dragonwood+</option>

<option value="E.CongalalaPelt+">E.CongalalaPelt+</option>
<option value="Earth Crystal">Earth Crystal</option>
<option value="ElderDragonBlood">ElderDragonBlood</option>
<option value="Electro Sac">Electro Sac</option>
<option value="Emperor Cricket">Emperor Cricket</option>
<option value="Energy Drink">Energy Drink</option>
<option value="Exciteshroom">Exciteshroom</option>
<option value="Fatalis Eye">Fatalis Eye</option>
<option value="Fatalis Horn">Fatalis Horn</option>

<option value="Fatalis Scale">Fatalis Scale</option>
<option value="Felvine">Felvine</option>
<option value="Fire Dragon Pwdr">Fire Dragon Pwdr</option>
<option value="Fire Drgn Jewel">Fire Drgn Jewel</option>
<option value="Fire Drgn Webbing">Fire Drgn Webbing</option>
<option value="Fire Herb">Fire Herb</option>
<option value="Fire Wyvern Claw">Fire Wyvern Claw</option>
<option value="Firecell Stone">Firecell Stone</option>
<option value="Firestone">Firestone</option>

<option value="FireWyvrn BrnStm">FireWyvrn BrnStm</option>
<option value="Flabby Hide">Flabby Hide</option>
<option value="Flame Sac">Flame Sac</option>
<option value="Flute">Flute</option>
<option value="FlynMealPassPlus">FlynMealPassPlus</option>
<option value="FlynMealPassReg">FlynMealPassReg</option>
<option value="Gaoren Carapace">Gaoren Carapace</option>
<option value="Gaoren Claw">Gaoren Claw</option>
<option value="Gaoren Pincer">Gaoren Pincer</option>

<option value="Gaoren Shell">Gaoren Shell</option>
<option value="Gaoren Spine">Gaoren Spine</option>
<option value="Gaoren Thoracic">Gaoren Thoracic</option>
<option value="Garuga Ear">Garuga Ear</option>
<option value="Garuga Mane">Garuga Mane</option>
<option value="Garuga Scale">Garuga Scale</option>
<option value="Garuga Wing">Garuga Wing</option>
<option value="Gastronome Tuna">Gastronome Tuna</option>
<option value="Gendrome Hide">Gendrome Hide</option>

<option value="Gendrome Skull">Gendrome Skull</option>
<option value="Gendrome Tail">Gendrome Tail</option>
<option value="Genprey Fang">Genprey Fang</option>
<option value="Genprey Hide+">Genprey Hide+</option>
<option value="Giadrome Claw">Giadrome Claw</option>
<option value="Giadrome Hide">Giadrome Hide</option>
<option value="Giant Bone">Giant Bone</option>
<option value="Giaprey Hide+">Giaprey Hide+</option>
<option value="Giaprey Scale">Giaprey Scale</option>

<option value="Giaprey Scale+">Giaprey Scale+</option>
<option value="Glutton Tuna">Glutton Tuna</option>
<option value="Gold Rajang Pelt">Gold Rajang Pelt</option>
<option value="Golden Egg">Golden Egg</option>
<option value="GoldRajangPelt+">GoldRajangPelt+</option>
<option value="Gourmet Fish+">Gourmet Fish+</option>
<option value="Gourmet Steak">Gourmet Steak</option>
<option value="Gravios Brainstm">Gravios Brainstm</option>
<option value="Gravios Carapace">Gravios Carapace</option>

<option value="Gravios Shell">Gravios Shell</option>
<option value="Gravios Skl Shl">Gravios Skl Shl</option>
<option value="Great Hornfly">Great Hornfly</option>
<option value="Grn Plesioth Fin">Grn Plesioth Fin</option>
<option value="Grn Plesioth Scl">Grn Plesioth Scl</option>
<option value="Grn Plesioth Scl+">Grn Plesioth Scl+</option>
<option value="Gunpowder">Gunpowder</option>
<option value="Gypceros Head">Gypceros Head</option>
<option value="Hard Gaoren Claw">Hard Gaoren Claw</option>

<option value="HardGypcerosHead">HardGypcerosHead</option>
<option value="Health Flute">Health Flute</option>
<option value="Herbal Medicine">Herbal Medicine</option>
<option value="Hercudrome">Hercudrome</option>
<option value="Hermitaur Claw">Hermitaur Claw</option>
<option value="Hermitaur Claw+">Hermitaur Claw+</option>
<option value="Hermitaur Shell">Hermitaur Shell</option>
<option value="Honey">Honey</option>
<option value="Hornet Razorwing">Hornet Razorwing</option>

<option value="Hornetaur Head">Hornetaur Head</option>
<option value="HornetaurInnrWng">HornetaurInnrWng</option>
<option value="HrdBlangongaPlt+">HrdBlangongaPlt+</option>
<option value="HrdCeanataurClaw">HrdCeanataurClaw</option>
<option value="HrdCongalalaPlt+">HrdCongalalaPlt+</option>
<option value="HrdE.CongaClaw">HrdE.CongaClaw</option>
<option value="HrdFireWyvernClaw">HrdFireWyvernClaw</option>
<option value="HrdHermitaurClaw">HrdHermitaurClaw</option>
<option value="Hvy Gaoren Spine">Hvy Gaoren Spine</option>

<option value="Hvy Kut-Ku Shell">Hvy Kut-Ku Shell</option>
<option value="HvyAzurRthlsShl">HvyAzurRthlsShl</option>
<option value="HvyBlangongaFang">HvyBlangongaFang</option>
<option value="HvyC.BlamgoFang">HvyC.BlamgoFang</option>
<option value="HvyDiablosSpine">HvyDiablosSpine</option>
<option value="HvyGraviosShell">HvyGraviosShell</option>
<option value="HvyLavasiothFang">HvyLavasiothFang</option>
<option value="HvyLavasiothShl">HvyLavasiothShl</option>
<option value="HvyPiscineFang">HvyPiscineFang</option>

<option value="Hypno Beak">Hypno Beak</option>
<option value="Hypno Fang">Hypno Fang</option>
<option value="Ice  Crystal">Ice  Crystal</option>
<option value="Ice Crystal">Ice Crystal</option>
<option value="Immunizer">Immunizer</option>
<option value="Iodrome Skull">Iodrome Skull</option>
<option value="Ioprey Fang">Ioprey Fang</option>
<option value="Iron Ore">Iron Ore</option>
<option value="Ivy">Ivy</option>

<option value="Kelbi Hide">Kelbi Hide</option>
<option value="Kelbi Horn">Kelbi Horn</option>
<option value="Khezu Hide - Tan">Khezu Hide - Tan</option>
<option value="KhezuHide-Cream">KhezuHide-Cream</option>
<option value="Killer Beetle">Killer Beetle</option>
<option value="Kirin Azure Horn">Kirin Azure Horn</option>
<option value="Kirin Hide">Kirin Hide</option>
<option value="Kirin Horn">Kirin Horn</option>
<option value="Kirin Mane">Kirin Mane</option>

<option value="Knife Mackeral">Knife Mackeral</option>
<option value="Kut-Ku Ear">Kut-Ku Ear</option>
<option value="Kut-Ku Scale">Kut-Ku Scale</option>
<option value="Lao-Shan's Claw">Lao-Shan's Claw</option>
<option value="Lao-Shan's Horn">Lao-Shan's Horn</option>
<option value="Lao-Shan's Scale">Lao-Shan's Scale</option>
<option value="Lao-Shan's Shell">Lao-Shan's Shell</option>
<option value="Lao-ShanCarapace">Lao-ShanCarapace</option>
<option value="LapisLazuliJewel">LapisLazuliJewel</option>

<option value="LeathrBlangoTail">LeathrBlangoTail</option>
<option value="LethrGarugaTail">LethrGarugaTail</option>
<option value="Lg Lobstershell">Lg Lobstershell</option>
<option value="Lg Pelagus Fang">Lg Pelagus Fang</option>
<option value="Lifecrystals">Lifecrystals</option>
<option value="Lifepowder">Lifepowder</option>
<option value="Long Garuga Ear">Long Garuga Ear</option>
<option value="Lthr Pelagus Plt">Lthr Pelagus Plt</option>
<option value="LthrC.BlangoTail">LthrC.BlangoTail</option>

<option value="LthrChameleosTail">LthrChameleosTail</option>
<option value="LthrKirinThndrTI">LthrKirinThndrTI</option>
<option value="LthrSlvrRthlsTal">LthrSlvrRthlsTal</option>
<option value="Lunastra Shell">Lunastra Shell</option>
<option value="Lunastra Spike">Lunastra Spike</option>
<option value="LunastraCarapace">LunastraCarapace</option>
<option value="Machalite Ore">Machalite Ore</option>
<option value="Majestic Horn">Majestic Horn</option>
<option value="Mega ArmorSkin">Mega ArmorSkin</option>

<option value="Mega Bugnet">Mega Bugnet</option>
<option value="Mega Demondrug">Mega Demondrug</option>
<option value="Mega Juice">Mega Juice</option>
<option value="Mega Pickaxe">Mega Pickaxe</option>
<option value="Monoblos Heart">Monoblos Heart</option>
<option value="Monoblos Spine">Monoblos Spine</option>
<option value="MonoblosCarapace">MonoblosCarapace</option>
<option value="Monster Broth">Monster Broth</option>
<option value="Mosswine Hide">Mosswine Hide</option>

<option value="Narga Brain Stem">Narga Brain Stem</option>
<option value="Narga Scale+">Narga Scale+</option>
<option value="NargaCuttingWing">NargaCuttingWing</option>
<option value="Net">Net</option>
<option value="Nitroshroom">Nitroshroom</option>
<option value="Normal S Lv3">Normal S Lv3</option>
<option value="OrangeHypnoPelt">OrangeHypnoPelt</option>
<option value="OrangeHypnoPelt+">OrangeHypnoPelt+</option>
<option value="Pale Bone">Pale Bone</option>

<option value="Pale Extract">Pale Extract</option>
<option value="Pale Khezu Steak">Pale Khezu Steak</option>
<option value="Paralysis Sac">Paralysis Sac</option>
<option value="ParalysisCoating">ParalysisCoating</option>
<option value="Pawprint Stamp">Pawprint Stamp</option>
<option value="Pellet S Lv3">Pellet S Lv3</option>
<option value="Pierce S Lv3">Pierce S Lv3</option>
<option value="Piercing Claw">Piercing Claw</option>
<option value="Pin Tuna">Pin Tuna</option>

<option value="Piscine Fang">Piscine Fang</option>
<option value="Plesioth Fin">Plesioth Fin</option>
<option value="Plesioth Fin+">Plesioth Fin+</option>
<option value="Plesioth Scale">Plesioth Scale</option>
<option value="PlumD.HermitrClw">PlumD.HermitrClw</option>
<option value="PlumD.HermitrShl">PlumD.HermitrShl</option>
<option value="Pnk Rathian Shl">Pnk Rathian Shl</option>
<option value="Poison Sac">Poison Sac</option>
<option value="Posion Coating">Posion Coating</option>

<option value="Power Coating">Power Coating</option>
<option value="Power Extract">Power Extract</option>
<option value="Power Juice">Power Juice</option>
<option value="Power Pill">Power Pill</option>
<option value="Power Seed">Power Seed</option>
<option value="Psychoserum">Psychoserum</option>
<option value="Pur Rubbery Hide">Pur Rubbery Hide</option>
<option value="Purecrystal">Purecrystal</option>
<option value="Rainbow Ore">Rainbow Ore</option>

<option value="RainbowTailFeath">RainbowTailFeath</option>
<option value="Rajang Horn">Rajang Horn</option>
<option value="Rajang Tail">Rajang Tail</option>
<option value="Rathalos Plate">Rathalos Plate</option>
<option value="Rathalos Ruby">Rathalos Ruby</option>
<option value="Rathalos Wing">Rathalos Wing</option>
<option value="Rathian Plate">Rathian Plate</option>
<option value="Rathian Spike">Rathian Spike</option>
<option value="Rathian Spike+">Rathian Spike+</option>

<option value="Remobra Skull">Remobra Skull</option>
<option value="RobustWyvernBone">RobustWyvernBone</option>
<option value="Rubbery Hide">Rubbery Hide</option>
<option value="Rubbery Hide+">Rubbery Hide+</option>
<option value="Rumblefish">Rumblefish</option>
<option value="ShakaInheritance">ShakaInheritance</option>
<option value="ShakalakaTreasr+">ShakalakaTreasr+</option>
<option value="ShakalakaTreasre">ShakalakaTreasre</option>
<option value="Sharp Claw">Sharp Claw</option>

<option value="Sharpened Beak">Sharpened Beak</option>
<option value="Shock Trap">Shock Trap</option>
<option value="SilverGarugaPelt">SilverGarugaPelt</option>
<option value="Sinister Cloth">Sinister Cloth</option>
<option value="Sleep Coating">Sleep Coating</option>
<option value="Sleep Herb">Sleep Herb</option>
<option value="Sleep Sac">Sleep Sac</option>
<option value="Sleepyfish">Sleepyfish</option>
<option value="Slvr Rthlos Tail">Slvr Rthlos Tail</option>

<option value="Slvr Rthlos Wing">Slvr Rthlos Wing</option>
<option value="Sm Ceanataur Shl">Sm Ceanataur Shl</option>
<option value="Sm Hermitaur Shl">Sm Hermitaur Shl</option>
<option value="Sm Lobstershell">Sm Lobstershell</option>
<option value="SpecChamelehide+">SpecChamelehide+</option>
<option value="SpecGrnPlesioFn+">SpecGrnPlesioFn+</option>
<option value="SpecialKirinHide">SpecialKirinHide</option>
<option value="SpecPlesiothFin+">SpecPlesiothFin+</option>
<option value="SpecRemobraSkin+">SpecRemobraSkin+</option>

<option value="Springnight Carp">Springnight Carp</option>
<option value="Steel Egg">Steel Egg</option>
<option value="Str Fatalis Wng">Str Fatalis Wng</option>
<option value="StrAlluringWing">StrAlluringWing</option>
<option value="StrNargaCttnhWng">StrNargaCttnhWng</option>
<option value="StrRathalosWing">StrRathalosWing</option>
<option value="Suiko Jewel">Suiko Jewel</option>
<option value="Sunset Herb">Sunset Herb</option>
<option value="Tailed Frog">Tailed Frog</option>

<option value="Teostra Horn+">Teostra Horn+</option>
<option value="Teostra Shell">Teostra Shell</option>
<option value="TerraCeanatrClaw">TerraCeanatrClaw</option>
<option value="ThckDaoraDrgnScl">ThckDaoraDrgnScl</option>
<option value="ThckFireDrgnScl">ThckFireDrgnScl</option>
<option value="ThckGrnPlesioScl">ThckGrnPlesioScl</option>
<option value="ThckPnkRathnScl">ThckPnkRathnScl</option>
<option value="ThkBullfangoPelt">ThkBullfangoPelt</option>
<option value="Thuderbug Juice">Thuderbug Juice</option>

<option value="Thunderbug">Thunderbug</option>
<option value="Thunderbug Jelly">Thunderbug Jelly</option>
<option value="Tigrex Fang">Tigrex Fang</option>
<option value="Tigrex Skull Shl">Tigrex Skull Shl</option>
<option value="Top-GrdRedHorn">Top-GrdRedHorn</option>
<option value="Trap Tool">Trap Tool</option>
<option value="Twisted Horn">Twisted Horn</option>
<option value="TwstBlkBlosHrn">TwstBlkBlosHrn</option>
<option value="UkanlosDiggngClaw">UkanlosDiggngClaw</option>

<option value="UkanlosUnderscl">UkanlosUnderscl</option>
<option value="Unknown Skull">Unknown Skull</option>
<option value="Velocidrome Claw">Velocidrome Claw</option>
<option value="Velociprey Fang">Velociprey Fang</option>
<option value="Vespoid Abdomen">Vespoid Abdomen</option>
<option value="Vespoid InnrWng">Vespoid InnrWng</option>
<option value="Vespoid Shell">Vespoid Shell</option>
<option value="Vespoid Wing">Vespoid Wing</option>
<option value="VespoidQn'sCrown">VespoidQn'sCrown</option>

<option value="Vibrant Comb">Vibrant Comb</option>
<option value="Vspoid Razorwing">Vspoid Razorwing</option>
<option value="Well-Done Steak">Well-Done Steak</option>
<option value="Wht Monoblos Hrn">Wht Monoblos Hrn</option>
<option value="Wyvern Fang">Wyvern Fang</option>
<option value="Wyvern Skull Shl">Wyvern Skull Shl</option>
<option value="Wyvern Stone">Wyvern Stone</option>
<option value="YamaTsukamiHide">YamaTsukamiHide</option>
<option value="Yambug">Yambug</option>
<?
}


function printSkills()
{
?>
<option value="Any">Any</option>
<option value="Alchemy">Alchemy</option>
<option value="All Resist">All Resist</option>
<option value="Anti-Theft">Anti-Theft</option>
<option value="Antiseptic">Antiseptic</option>
<option value="Artisan">Artisan</option>
<option value="Attack">Attack</option>
<option value="Auto-Guard">Auto-Guard</option>
<option value="AutoReload">AutoReload</option>

<option value="Backpackng">Backpackng</option>
<option value="BBQ">BBQ</option>
<option value="BombStrUp">BombStrUp</option>
<option value="Capacity">Capacity</option>
<option value="Carving">Carving</option>
<option value="CLsRngCAdd">CLsRngCAdd</option>
<option value="ClustS Add">ClustS Add</option>
<option value="Cold Res">Cold Res</option>
<option value="ComradeAtk">ComradeAtk</option>

<option value="ComradeDef">ComradeDef</option>
<option value="ComrdGuide">ComrdGuide</option>
<option value="Consitutn">Consitutn</option>
<option value="Cooking">Cooking</option>
<option value="Crag S Add">Crag S Add</option>
<option value="Defense">Defense</option>
<option value="Dragon Res">Dragon Res</option>
<option value="ElementAtk">ElementAtk</option>
<option value="Evade">Evade</option>

<option value="Evade Dist">Evade Dist</option>
<option value="Everlastng">Everlastng</option>
<option value="Expert">Expert</option>
<option value="Faint">Faint</option>
<option value="Fate">Fate</option>
<option value="Fatigue">Fatigue</option>
<option value="Fencing">Fencing</option>
<option value="Fire Res">Fire Res</option>
<option value="Fishing">Fishing</option>

<option value="Gathering">Gathering</option>
<option value="Gluttony">Gluttony</option>
<option value="Guard">Guard</option>
<option value="Guard Up">Guard Up</option>
<option value="Gunnery">Gunnery</option>
<option value="Guts">Guts</option>
<option value="Health">Health</option>
<option value="HearProtct">HearProtct</option>
<option value="Heat Res">Heat Res</option>

<option value="HiSpdGathr">HiSpdGathr</option>
<option value="Horn">Horn</option>
<option value="Hunger">Hunger</option>
<option value="Ice Res">Ice Res</option>
<option value="Map">Map</option>
<option value="MixSucRate">MixSucRate</option>
<option value="NormalS Up">NormalS Up</option>
<option value="NormalSAdd">NormalSAdd</option>
<option value="ParalyCAdd">ParalyCAdd</option>

<option value="Paralysis">Paralysis</option>
<option value="PelletS Up">PelletS Up</option>
<option value="PelletSAdd">PelletSAdd</option>
<option value="Perceive">Perceive</option>
<option value="PierceS Up">PierceS Up</option>
<option value="PierceSAdd">PierceSAdd</option>
<option value="Poison">Poison</option>
<option value="PoisonCAdd">PoisonCAdd</option>
<option value="Potential">Potential</option>

<option value="PowerCAdd">PowerCAdd</option>
<option value="Precision">Precision</option>
<option value="Protection">Protection</option>
<option value="PsychicVis">PsychicVis</option>
<option value="Quake Res">Quake Res</option>
<option value="Rec Speed">Rec Speed</option>
<option value="Recoil">Recoil</option>
<option value="Recovery">Recovery</option>
<option value="Reload">Reload</option>

<option value="Sharpness">Sharpness</option>
<option value="ShortCharg">ShortCharg</option>
<option value="Shot Mix">Shot Mix</option>
<option value="Sleep">Sleep</option>
<option value="SleepCAdd">SleepCAdd</option>
<option value="Sneak">Sneak</option>
<option value="Snow Res">Snow Res</option>
<option value="Spc Attack">Spc Attack</option>
<option value="SpeedSetup">SpeedSetup</option>

<option value="Stamina">Stamina</option>
<option value="SwdShrpner">SwdShrpner</option>
<option value="Sword Draw">Sword Draw</option>
<option value="Terrain">Terrain</option>
<option value="Throw">Throw</option>
<option value="ThunderRes">ThunderRes</option>
<option value="Tranquilzr">Tranquilzr</option>
<option value="Water Res">Water Res</option>
<option value="Whim">Whim</option>

<option value="Wide Area">Wide Area</option>
<option value="WindPress">WindPress</option>
            <option value="Alchemy">Alchemy</option>
<option value="All Resist">All Resist</option>
<option value="Anti-Theft">Anti-Theft</option>
<option value="Antiseptic">Antiseptic</option>
<option value="Artisan">Artisan</option>
<option value="Attack">Attack</option>
<option value="Auto-Guard">Auto-Guard</option>
<option value="AutoReload">AutoReload</option>

<option value="Backpackng">Backpackng</option>
<option value="BBQ">BBQ</option>
<option value="BombStrUp">BombStrUp</option>
<option value="Capacity">Capacity</option>
<option value="Carving">Carving</option>
<option value="CLsRngCAdd">CLsRngCAdd</option>
<option value="ClustS Add">ClustS Add</option>
<option value="Cold Res">Cold Res</option>
<option value="ComradeAtk">ComradeAtk</option>

<option value="ComradeDef">ComradeDef</option>
<option value="ComrdGuide">ComrdGuide</option>
<option value="Consitutn">Consitutn</option>
<option value="Cooking">Cooking</option>
<option value="Crag S Add">Crag S Add</option>
<option value="Defense">Defense</option>
<option value="Dragon Res">Dragon Res</option>
<option value="ElementAtk">ElementAtk</option>
<option value="Evade">Evade</option>

<option value="Evade Dist">Evade Dist</option>
<option value="Everlastng">Everlastng</option>
<option value="Expert">Expert</option>
<option value="Faint">Faint</option>
<option value="Fate">Fate</option>
<option value="Fatigue">Fatigue</option>
<option value="Fencing">Fencing</option>
<option value="Fire Res">Fire Res</option>
<option value="Fishing">Fishing</option>

<option value="Gathering">Gathering</option>
<option value="Gluttony">Gluttony</option>
<option value="Guard">Guard</option>
<option value="Guard Up">Guard Up</option>
<option value="Gunnery">Gunnery</option>
<option value="Guts">Guts</option>
<option value="Health">Health</option>
<option value="HearProtct">HearProtct</option>
<option value="Heat Res">Heat Res</option>

<option value="HiSpdGathr">HiSpdGathr</option>
<option value="Horn">Horn</option>
<option value="Hunger">Hunger</option>
<option value="Ice Res">Ice Res</option>
<option value="Map">Map</option>
<option value="MixSucRate">MixSucRate</option>
<option value="NormalS Up">NormalS Up</option>
<option value="NormalSAdd">NormalSAdd</option>
<option value="ParalyCAdd">ParalyCAdd</option>

<option value="Paralysis">Paralysis</option>
<option value="PelletS Up">PelletS Up</option>
<option value="PelletSAdd">PelletSAdd</option>
<option value="Perceive">Perceive</option>
<option value="PierceS Up">PierceS Up</option>
<option value="PierceSAdd">PierceSAdd</option>
<option value="Poison">Poison</option>
<option value="PoisonCAdd">PoisonCAdd</option>
<option value="Potential">Potential</option>

<option value="PowerCAdd">PowerCAdd</option>
<option value="Precision">Precision</option>
<option value="Protection">Protection</option>
<option value="PsychicVis">PsychicVis</option>
<option value="Quake Res">Quake Res</option>
<option value="Rec Speed">Rec Speed</option>
<option value="Recoil">Recoil</option>
<option value="Recovery">Recovery</option>
<option value="Reload">Reload</option>

<option value="Sharpness">Sharpness</option>
<option value="ShortCharg">ShortCharg</option>
<option value="Shot Mix">Shot Mix</option>
<option value="Sleep">Sleep</option>
<option value="SleepCAdd">SleepCAdd</option>
<option value="Sneak">Sneak</option>
<option value="Snow Res">Snow Res</option>
<option value="Spc Attack">Spc Attack</option>
<option value="SpeedSetup">SpeedSetup</option>

<option value="Stamina">Stamina</option>
<option value="SwdShrpner">SwdShrpner</option>
<option value="Sword Draw">Sword Draw</option>
<option value="Terrain">Terrain</option>
<option value="Throw">Throw</option>
<option value="ThunderRes">ThunderRes</option>
<option value="Tranquilzr">Tranquilzr</option>
<option value="Water Res">Water Res</option>
<option value="Whim">Whim</option>

<option value="Wide Area">Wide Area</option>
<option value="WindPress">WindPress</option>
<?
}
function mg_dbconnect()
{

   mysql_connect("localhost","mh_user","wehaterobo") or die(mysql_error());
   mysql_select_db("minegarde_mhp2garmors") or die(mysql_error()); 
}



?>

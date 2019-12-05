<?php
class ConvertNumberToWriteWay{
    public function getDivisor($number){
        $divisor;
        for($counter=0; $counter<8; $counter++){
            if($number < pow(10,$counter+1)){
                $divisor = $counter;
                break;
            }
        }
        return $divisor;
    }
    
    public function threeDigits($number){
        $units = ["un", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
        $tensw = ["once", "doce", "trece", "catorce", "quince"];
        $tens = ["diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
        $hundreds = ["ciento", "doscientos", "trescientos", "cuatrocientos","quinientos","seiscientos","setecientos","ochocientos","novecientos"];
        
        $tenFlag = false;
        $iFlag = true;
        $twentyFlag = false;
        $divisor = $this->getDivisor($number);
        $output = "";
        
        for($counter=$divisor; $counter>=0; $counter--){
            $powVal = intval($number/pow(10,$counter))-1;
            if($counter == 0){
                if(($powVal>=0 && !$tenFlag)) {
                    if($iFlag && $divisor != 0) $output .= "i";
                    else $output .= " ";
                    $output .= $units[$powVal];
                }
                elseif($tenFlag) $output = substr($output,0,-4).$tensw[$powVal];
            }
            elseif ($counter == 1) {
                if($powVal>0) $output .= " ".$tens[$powVal];
                elseif($powVal == 0) {
                    $output .= " diec";
                    $tenFlag = true;
                }
                else $iFlag = false;
                if($powVal == 1) {
                    $output = substr($output,0,-1);
                    $twentyFlag = true;
                }
            }
            elseif ($counter == 2){
                $output .= $hundreds[$powVal];
            }
            if($number == 0 && $twentyFlag) {
                echo($number);
                $output .= "e";
                $twentyFlag = false;
            }
            $number -= intval($number/pow(10,$counter))*pow(10,$counter); 
        }
        return $output; 
    }
    
    public  function numberToWrite($number){
        $powers = ["mil", "millon"];
        $divisor = $this->getDivisor($number);
        $output = "";
        
        if($divisor>=6) $divisor = 6;
        elseif($divisor>=3) $divisor = 3;
        else $divisor = 0;
        
        for($counter=$divisor; $counter>=0;$counter-=3){
            $powVal = intval($number/pow(10,$counter));
            if($powVal != 1) $output .= $this->threeDigits($powVal)." ";
            if($powVal==100) $output= substr($output,0,-3);
            if($counter != 0) $output .= " ".$powers[($counter/3)-1]. " ";
            if($powVal != 1 && $counter == 6) $output = substr($output,0,-1)."es " ;
            $number -= intval($number/pow(10,$counter))*pow(10,$counter);
        }
        return trim(str_replace("  ", " ",$output));
    }
}

$converter = new ConvertNumberToWriteWay;
$output = $converter->numberToWrite(99145107);
echo("la salida es $output");
?>
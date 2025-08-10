<?php

namespace Dist\Models;

use Illuminate\Database\Eloquent\Model;

use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf extends Fpdf
{
    
    public function Header()
    {
        if (!$this->skipHeader) {
            // ...
            $this->Image('img/margen.png',0,15,360);
        
            $this->SetFont('Arial','B',12);
            $this->SetTextColor(25, 137, 193);
            $this->Cell(0,5,"COLEGIO MEDICO DE POTOSI",0,0,"C");
            $this->Ln(15);
        }
        
    }

    function vcell($c_width,$c_height,$x_axis,$text)
    {
        $wrap=$c_height/24;
        $wrap0=$wrap+16;// First line of text (+8 from previous)	
        $wrap1=$wrap+24;// Second line of text (+8 from previous)
        $wrap2=$wrap+32;// Third line of text (+8 from previous)
        $wrap3=$wrap+40;// Fourth line of text (+8 from previous)
        $wrap4=$wrap+48;// Fifth line of text (+8 from previous)
        $wrap5=$wrap+56;// Sixth line of text (+8 from previous)
        $wrap6=$wrap+64;// Seventh line of text (+8 from previous)
        
        $len=strlen($text);// Splits the text into 64 character each and saves in a array 
    
        if($len>64)
        { 
            $wrap_text_array=str_split($text,64);//This sets the length of each array to 64 characters
            
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap0,$wrap_text_array[0],'','','');// First line of text		
            
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap1,$wrap_text_array[1],'','','');// Second line of text
            
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap2,$wrap_text_array[2],'','','');// Third line of text
    
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap3,$wrap_text_array[3],'','','');// Fourth line of text		
    
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap4,$wrap_text_array[4],'','','');// Fifth line of text	
    
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap5,$wrap_text_array[5],'','','');// Sixth line of text	
    
            $this->SetX($x_axis);
            $this->Cell($c_width,$wrap6,$wrap_text_array[6],'','','');// Seventh line of text	
            
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,'','LTR',0,'L',0);
        }
        else
        {
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);
        }    
    }    

    public function Footer()
    {
        if (!$this->skipFooter) 
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
        }
        
    }
    function LoadData()
    {
        $data = array();
        for($i=0;$i<10;$i++)
            //$data[] = "explode(';',trim($line))";
            $data[]="dato".$i;
        return $data;
    }

    // Tabla simple
    function BasicTable($header, $data,$tam,$p)
    {
        // Cabecera
        //return $header;
        $this->SetFont('Arial', 'B', 12);
        $i=0;
        $this->SetFillColor(25, 137, 193);
        $this->Cell($p,7,'',0,0,'C');
        $this->SetTextColor(255,255,255);
        foreach($header as $col)
        {
            $this->Cell($tam[$i],7,$col,1,0,'C',true);
            $i++;
        }
            
        $this->Ln();
        $this->SetTextColor(0,0,0);
        // Datos
        $this->SetFont('Arial', '', 9);
        $con=1;
        foreach($data as $row)
        {
            
            $this->Cell($p,7,'',0,0,'C');
            // CALCULAR MAXIMO BEGIN
            $line = 0;    
            $i = 0;
            $idata = $row;  
            foreach($idata as $itext)
            {
                //$aux = $this->getMaxCell($itext, $tam[$i], 5);
                $aux = $this->NbLines($tam[$i], $itext);
                if( $line < $aux)
                {
                    $line = $aux;
                }
                $i++;
            }
            // CALCULAR MAXIMO END
            $i = 0;    
            if($con%2==0)
                $this->SetFillColor(255, 255, 255);
            else
                $this->SetFillColor(245, 245, 245);
            
            foreach($row as $text)
            {
                $cellHeight     = 8;
                $cellWidth      = $tam[$i];
                //$laux           = $this->getMaxCell($text, $tam[$i], 5);
                $laux           = $this->NbLines($tam[$i], $text);
                $MaxCellHeigth  = $line*$cellHeight;
                if($laux<=1)
                {
                   
                    $this->Cell($cellWidth,$MaxCellHeigth,$text,1,0,'L',true);
                }    
                else 
                {
                    while( $laux < $line ){ $text=$text."\n"."\n"; $laux++; }    
                    $xPos   =   $this->GetX();
                    $yPos   =   $this->GetY();
                    $this->MultiCell($cellWidth, $cellHeight,$text,1,'1','L',true);
                    $x_axis=$this->getx();
                    //$this->vcell($cellWidth,$MaxCellHeigth,$xPos,$text);
                    $this->SetXY($xPos + $cellWidth, $yPos);
                    //$this->Cell(10,($line+$cellHeight),$item[3],1,1);                            

                    //$this->Cell($tam[$i],6,$max.$text,1);
                }    
                $i++;
            }
            $con++;
            $line=1;
            while($line>0) 
            {
                $this->Ln();
                $line--;
            }    
        }


        
        // width, heigth, x_axis, data, ?, border, alignment, enable background color
        /*
        $c_width=115;
        $c_height=35;
        $text = "ASD";

        $x_axis=$this->getx();
        $this->vcell($c_width,$c_height,$x_axis,$text);        
        $this->vcell($c_width,$c_height,$x_axis,$text);        
        */
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }    

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }    

    public function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }    

    public function getMaxCell($txt, $jcellWidth, $jcellheight)
    {
        $line = 1;
        if($this->GetStringWidth($txt) < $jcellWidth)
        {
            $line = 1;
        }        
        else
        {
            $textLength = strlen($txt);
            $errMargin  = 10; // EYE
            $startChar  = 0;
            $maxChar    = 0;
            $textArray  = array();
            $tmpString  = '';
            
            while($startChar < $textLength)
            {
                while($this->GetStringWidth($tmpString) < ($jcellWidth-$errMargin) && ($startChar+$maxChar) < $textLength)
                {
                    $maxChar++;
                    $tmpString = substr($txt, $startChar, $maxChar);       
                }
                $startChar  =  $startChar + $maxChar;
                array_push($textArray, $tmpString);
                $maxChar    =  0;
                $tmpString  =  '';
            }
            $line   =   count($textArray);            
        }
        return $line;
    }

}
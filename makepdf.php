<?php
	require("fpdf/fpdf.php");

	class PDF_Rotate extends FPDF{
		var $angle = 0;

		function Rotate($angle, $x=-1, $y=-1){
    		if($x == -1) $x = $this->x;
    		if($y == -1) $y = $this->y;
    		if($this->angle != 0) $this->_out('Q');
    		$this->angle = $angle;
    		if($angle != 0){
    			$angle *= M_PI/180;
    			$c = cos($angle);
    			$s = sin($angle);
    			$cx = $x * $this->k;
    			$cy = ($this->h - $y) * $this->k;
    			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    		}
		}

		function _endpage(){
			if($this->angle != 0){
				$this->angle = 0;
				$this->_out('Q');
			}
			parent::_endpage();
		}
	}

	class PDF extends PDF_Rotate{
		function RotatedImage($file, $x, $y, $w, $h, $angle){
    		// IMAGE ROTATED AROUND ITS UPPER-LEFT CORNER
    		$this->Rotate($angle, $x, $y);
    		$this->Image($file, $x, $y, $w, $h);
    		$this->Rotate(0);
		}
	}

	function makepdf($img_path, $padding, $rotated, $images, $img_w, $img_h, $save_path){
		$pdf = new PDF();
		$pdf->AddPage();
		$w = 210; $h = 297;
		if($padding == 0 && $rotated == 0){
			$x = 0; $y = 0;
			$counter = 0;
			while($counter != $images){
				if( ($x + $img_w) <= $w){
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, 0);
					$x += $img_w;
				} else {
					$x = 0;
					$y += $img_h;
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, 0);
					$x += $img_w;
				}
				$counter++;
			}
		} else if($padding == 0 && $rotated == 1){
			$x = 0; $y = 0;
			$counter = 0;
			// BECAUSE OF ROTATING IMAGE
			$x += $img_h;
			while($counter != $images){
				if($x <= $w){
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, -90);
					$x += $img_h;
				} else {
					$x = $img_h;
					$y += $img_w;
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, -90);
					$x += $img_h;
				}
				$counter++;
			}
		} else if($padding == 1 && $rotated == 0){
			$x = 0; $y = 0;
			$counter = 0;
			$l_marg = 30; $t_marg = 20; $r_marg = 15;
			// BECAUSE OF PADDINGS
			$x += $l_marg; $y += $t_marg;
			while($counter != $images){
				if( ($x + $img_w) <= ($w - $r_marg) ){
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, 0);
					$x += $img_w;
				} else {
					$x = $l_marg;
					$y += $img_h;
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, 0);
					$x += $img_w;
				}
				$counter++;
			}
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Rect(0, 277, 210, 20, "F");
		} else if($padding == 1 && $rotated == 1){
			$x = 0; $y = 0;
			$counter = 0;
			// MIX
			$l_marg = 30; $t_marg = 20; $r_marg = 15;
			$x += $img_h + $l_marg; $y += $t_marg;
			while($counter != $images){
				if($x <= ($w - $r_marg) ){
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, -90);
					$x += $img_h;
				} else {
					$x = $img_h + $l_marg;
					$y += $img_w;
					$pdf->RotatedImage($img_path, $x, $y, $img_w, $img_h, -90);
					$x += $img_h;
				}
				$counter++;
			}
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Rect(0, 277, 210, 20, "F");
		}
		$pdf->Output("F", $save_path);
		unlink($img_path);
	}
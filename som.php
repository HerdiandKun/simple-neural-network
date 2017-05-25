<?php

	 $dimensi = 4;
	 $kelas = 4;
	 $epoch = 1;
	 $jumlahdata;
	 $alpha=0.25;
	 $radius=0;
	 
	 $data[0] = array(1,-1,1,1);
	 $data[1] = array(-1,-1,1,1);
	 
	//$datatest[0]= array(-1,-1,1,1);	
	$d = array();
	$bob = array();
	function init_bobot($kelas,$dimensi){
			for($i=0;$i<$kelas;$i++){
				for($j=0;$j<$dimensi;$j++){
					$b[$j] = rand(1,10)/10;
				}
				$bobot[$i] = $b;
			}
			
			for($i=0;$i<$kelas;$i++){
				for($j=0;$j<$dimensi;$j++){
					echo "bobot $i $j =".$bobot[$i][$j].'<br/>';
				}
				echo '<br>';
			}
			return $bobot;
	}
	
	function calc($kelas,$dimensi,$bobot,$data){
		
		for($i=0;$i<$kelas;$i++){
			$d['d'.$i] = 0;
				for($j=0;$j<$dimensi;$j++){
					//echo $bobot[$i][$j] .'-'. $data[$j].' = ';
					$d['d'.$i] += pow(($bobot[$i][$j] - ($data[$j])),2);
					//echo pow(($bobot[$i][$j] - ($data[$j])),2).'<br/>';
				}
				//echo ' <br>';
			}
		for($i=0;$i<$kelas;$i++){
					echo 'D'.$i.' = '.$d['d'.$i].' ';
				echo '<br>';
		}
		
		echo 'Data Minimum : '.min($d).'<br/>';
		$key = array_keys($d, min($d))[0];
		echo 'Update : '.substr($key,1);
		return substr($key,1);
	}
	
	function update($kelas,$dimensi,$d,$bobot,$data, $alpha, $radius){
		for(;$radius>=0;$radius--){
			for($j = 0;$j<$dimensi;$j++){
				if($radius != 0){
					if($d != 0){
					$bobot[$d-$radius][$j] = $bobot[$d-$radius][$j] + ($alpha *($data[$j] - $bobot[$d-$radius][$j]));	
					}
					if($d != $kelas-1){
					$bobot[$d+$radius][$j] = $bobot[$d+$radius][$j] + ($alpha *($data[$j] - $bobot[$d+$radius][$j]));
					}
				}else{
					$bobot[$d][$j] = $bobot[$d][$j] + ($alpha *($data[$j] - $bobot[$d][$j]));
				}
			}
		}
		echo '<br/> BOBOT BARU <br/>';
		
		for($i=0;$i<$kelas;$i++){
				for($j=0;$j<$dimensi;$j++){
					echo "bobot $i $j =".$bobot[$i][$j].'<br/>';
				}
				echo '<br>';
		}
		return $bobot;
	}
	
	function Test($kelas,$dimensi,$bobot,$data){
		
		for($i=0;$i<$kelas;$i++){
			$d['d'.$i] = 0;
				for($j=0;$j<$dimensi;$j++){
					//echo $bobot[$i][$j] .'-'. $data[$j].' = ';
					$d['d'.$i] += pow(($bobot[$i][$j] - ($data[$j])),2);
					//echo pow(($bobot[$i][$j] - ($data[$j])),2).'<br/>';
				}
				//echo ' <br>';
			}
		for($i=0;$i<$kelas;$i++){
					echo 'D'.$i.' = '.$d['d'.$i].' ';
				echo '<br>';
		}
		
		echo 'Data Minimum : '.min($d).'<br/>';
		$key = array_keys($d, min($d))[0];
		echo 'Kelas : '.$key;
	}
	
	$bob = init_bobot($kelas,$dimensi);
	for($ep = 1;$ep <= $epoch; $ep++){
		echo "<br/>========================EPOCH = $ep========================<br/>";
		for($i=0; $i< count($data);$i++){
			echo "<br/>========================DATA $i========================<br/>";
			$d = calc($kelas,$dimensi,$bob,$data[$i]);
			$bobot = update($kelas,$dimensi,$d,$bob,$data[$i],$alpha, $radius);
			//echo "<br/>========================DATA $i========================<br/>";
			$bob = $bobot;
		}
	}
	
	//Test($kelas,$dimensi,$bob,$datatest[0])
?>
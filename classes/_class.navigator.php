<?PHP

class navigator{

	
	/*======================================================================*\
	Function:	---
	Descriiption: ---
	\*======================================================================*/
	private function ParseURLNavigation($str, $page){
		$array_a = array("/page/{$page}/", "/page/{$page}", "#");
		return str_replace($array_a, "", $str);
	}
	
	/*======================================================================*\
	Function:	Navigation
	Descriiption: Вывод страниц с товарами
	\*======================================================================*/
	function Navigation($max, $page, $AllPages, $strURI){
	$strReturn = "";
	$left = false;
	$right = false;
	$strURI = $this->ParseURLNavigation($strURI, $page);
	$page = (intval($page) > 0) ? intval($page) : 1;
		if($AllPages <= $max){
			for($i = 1; $i <= $AllPages; $i++){
				if($i == $page){
					$strReturn .= "[$page] ";
				}else $strReturn .= "<a href=\"{$strURI}{$i}\" class='stn'>{$i}</a> ";
			}
		}else{
			for($i = 1; $i <= $AllPages; $i++){
				if($i == $page OR ($i == $page-1) OR ($i == $page-2)  OR ($i == $page-3) OR ($i == $page-4) OR ($i == $page+1) OR 
				($i == $page+2)  OR ($i == $page+3) OR ($i == $page+4)){
					if($i == $page){
						$strReturn .= "[$page] ";
					}else{
						$strReturn .= "<a href=\"{$strURI}{$i}\" class='stn'>{$i}</a> ";
					}
				}else{
					if($i > $page){
						if(!$right){ 
							if($page <= $AllPages-6){
								$strReturn .= " ... <a href=\"{$strURI}{$AllPages}\" class='stn'>{$AllPages}</a> "; $right = true;
							}else{
								$strReturn .= " <a href=\"{$strURI}{$AllPages}\" class='stn'>{$AllPages}</a> "; $right = true;
							}
						}
					}else{
						if(!$left){
							if($page > 6){
								$strReturn .= " <a href=\"{$strURI}1\" class='stn'>1</a> ... "; $left = true;
							}else{
								$strReturn .= " <a href=\"{$strURI}1\" class='stn'>1</a> "; $left = true;
							}
						}
					}
				}
			}
		}
		$left_str = ($page > 1) ? "<a href=\"{$strURI}".($page-1)."\" class='stn'>&laquo;</a> " : "&laquo; ";
		$right_str = ($page < $AllPages) ? " <a href=\"{$strURI}".($page+1)."\" class='stn'>&raquo;</a>" : " &raquo;";
		return $left_str.$strReturn.$right_str;
	}
}

?>
<?PHP
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */

class Navigator
{

    
    /*======================================================================*\
    Function:    ---
    Descriiption: ---
    \*======================================================================*/
    private function ParseURLNavigation($str, $page)
    {
        $array_a = array("/page/{$page}/", "/page/{$page}", "#");
        return str_replace($array_a, "", $str);
    }
    
    /*======================================================================*\
    Function:    Navigation
    Descriiption: Вывод страниц с товарами
    \*======================================================================*/
    function Navigation($max, $page, $AllPages, $strURI)
    {
        $open_tag = '<ul class="pagination">';
        $close_tag = '</ul>';
        $strReturn = "";
        $left = false;
        $right = false;
        $strURI = $this->ParseURLNavigation($strURI, $page);
        $page = (intval($page) > 0) ? intval($page) : 1;
        if($AllPages <= $max) {
            for($i = 1; $i <= $AllPages; $i++){
                if($i == $page) { // Active page
                    $strReturn .= "<li class=\"page-item active\"><span class=\"page-link\">{$page}</span></li>";
                }else { $strReturn .= "<li class=\"page-item\"><a href=\"{$strURI}{$i}\" class='page-link'>{$i}</a></li> ";
                }
            }
        }else{
            for($i = 1; $i <= $AllPages; $i++){
                if($i == $page OR ($i == $page-1) OR ($i == $page-2)  OR ($i == $page-3) OR ($i == $page-4) OR ($i == $page+1)  
                    OR ($i == $page+2)  OR ($i == $page+3) OR ($i == $page+4)
                ) {
                    if($i == $page) { // Active Page
                        $strReturn .= "<li class=\"page-item active\"><span class=\"page-link\">{$page}</span></li> ";
                    }else{
                        $strReturn .= "<li class=\"page-item\"><a href=\"{$strURI}{$i}\" class='page-link'>{$i}</a></li> ";
                    }
                }else{
                    if($i > $page) {
                        if(!$right) { 
                            if($page <= $AllPages-6) {
                                $strReturn .= " ... <a href=\"{$strURI}{$AllPages}\" class='page-link'>{$AllPages}</a></li> "; $right = true;
                            }else{
                                $strReturn .= " <li class=\"page-item\"><a href=\"{$strURI}{$AllPages}\" class='page-link'>{$AllPages}</a></li> "; $right = true;
                            }
                        }
                    }else{
                        if(!$left) {
                            if($page > 6) {
                                $strReturn .= " <li class=\"page-item\"><a href=\"{$strURI}1\" class='page-link'>1</a></li> ... "; $left = true;
                            }else{
                                $strReturn .= " <li class=\"page-item\"><a href=\"{$strURI}1\" class='page-link'>1</a></li> "; $left = true;
                            }
                        }
                    }
                }
            }
        }
        $left_str = ($page > 1) ? "<li class=\"page-item\"><a href=\"{$strURI}".($page-1)."\" class='page-link'>&laquo;</a> " : "<li class=\"page-item disabled\"><span class=\"page-link\">&laquo;</span>";
        $left_str .= "</li>";

        $right_str = ($page < $AllPages) ? " <li class=\"page-item\"><a href=\"{$strURI}".($page+1)."\" class='page-link'>&raquo;</a>" : " <li class=\"page-item disabled\"><span class=\"page-link\">&raquo;</span>";
        $right_str .= "</li>";
        return $open_tag.$left_str.$strReturn.$right_str.$close_tag;
    }
}

?>

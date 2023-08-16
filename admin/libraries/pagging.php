<?php 
function get_pagging($num_page, $page, $base_url = ""){
  $str_paging = "<ul id='list-paging' class='fl-right'>"; 
    if($page > 1) {
        $page_prev = $page - 1;
        $str_paging .= "<li><a href=\"{7$base_url}&page={$page_prev}\">Trước</a></li>";
    }
    for($i = 1; $i<= $num_page; $i++){
        $active = "";
        if($i == $page){
            // $active = "class = 'active'";
            $active = "active";
        }
        $str_paging .= "<li class='paggination_item {$active}' id='{$i}'><a href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if($page < $num_page) {
        $page_next = $page + 1;
        $str_paging .= "<li class='paggination_item_next'><a href=\"{$base_url}&page={$page_next}\">Sau</a></li>";
    }
  $str_paging .= "</ul>";    
  return $str_paging;                   
}

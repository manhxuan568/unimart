<?php

function discount($price_new,$price_old){
    if(!empty($price_new)){
        $discount = ($price_new - $price_old)/$price_old *100;
        return ceil($discount); 
    }
    return false; 
}

function has_child($data, $id){
    foreach ($data as $v) {
        if($v['parent_id'] == $id) return true;
    }
    return false;
}
function render_menu($data, $menu_class = "", $parent_id= 0, $level = 0){
    if($level == 0)
        $result = "<ul class='{$menu_class}'>";
    else
        $result = "<ul class='sub-menu'>";
    foreach ($data as $v) {
        if($v['parent_id'] == $parent_id){
            $result .= "<li>";
            $result .= "<a href='".route('productByCat',$v->slug)."' title=''>{$v->cat_name}</a>";
            if(has_child($data, $v->id)){
            $result .= render_menu($data,$menu_class = "", $v->id, $level + 1);
            $result .= "<i class='fa-solid fa-chevron-right arrow'></i>";
            $result .= "</li>";
            }
        }
    }
    $result .= "</ul>";
    return $result;
}
function navbar_toggle_menu($data, $menu_class = "", $parent_id= 0, $level = 0){
    if($level == 0)
        $result = "<ul class='{$menu_class}'>";
    else
        $result = "<ul class='sub-menu-navbar'>";
    foreach ($data as $v) {
        if($v['parent_id'] == $parent_id){
            $result .= "<li>";
            $result .= "<a href='".route('productByCat',$v->slug)."' title=''>{$v->cat_name}</a>";
            if(has_child($data, $v->id)){
            $result .= navbar_toggle_menu($data,$menu_class = "", $v->id, $level + 1);
            $result .= '<i class="fa-sharp fa-solid fa-chevron-up up-icon"></i>';
            $result .= "</li>";
            }
        }
    }
    $result .= "</ul>";
    return $result;
}

function add_product_ajax($data){
    foreach($data as $row){
        $result = "<li class='pro-item'>";
        $result .= "<div class='product-thumb'><a href='".route('productDetail',$row->options->slug)."'><img h-100 src='".url($row->options->thumbnail)."'alt=''></a></div>";
        $result .= "<div class='pro-info'>";
        $result .= "<div class='product-name'>".$row->name."</div>";
        $result .= "<div class='price'>Giá: ".number_format($row->price)."Đ</div>";
        $result .= "<div class='qty'>Số lượng:".$row->qty."</div>";
        $result .= "</div>";
        $result .= "</li>";
      
     }
      return $result;
}


function totalDashboard($list_order_success){
    if(isset($list_order_success)){
        $data=[];
        $t=0;
        foreach($list_order_success as $item){
            foreach(json_decode($item->info_order) as $v){
                $t+=$v->subtotal;
            }
        } 
        $data['total'] = $t;
       return $data['total'];
}  
    }
    
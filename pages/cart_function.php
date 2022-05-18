<?php 

    function total($cart){
        $total=0;
        foreach($cart as $key=>$value):{
            $total+=$value['price']*$value["quantity"];
        }
    endforeach;
    return $total;
    }
    

?>
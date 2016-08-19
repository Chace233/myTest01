<?php
function is_date($date)
{
    if($date == date('Y-m-d',strtotime($date)))
   {
   		return true;
   }
    else
   {
   		return false;
   } 
}
?>
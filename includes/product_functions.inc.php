<?php

//begin defining the function:
function get_stock_status($stock) {
  //return different messages based on the value of $stock:
  if ($stock > 5){
    return 'In Stock';
  } elseif ($stock > 0) {
    return 'Low Stock';
  } else {
    return 'Currently Out of Stock';
  }
} //End of get_stock_status() function.

//new function to display price
function get_price($type, $regular, $sales) {
  if ($type === 'coffee') {
    if ((0 < $sales) && ($sales < $regular)) {
      return ' Sale: $' . number_format($sales/100, 2) . '!';
    }
  } elseif ($type === 'goodies') {
    if ((0 < $sales) && ($sales < $regular)) {
      return '<strong>Sale Price:</strong> $' . number_format($sales/100, 2) .
      '! (normally $' . number_format($regular/100, 2) . ')<br />';
    } else {
      return '<strong>Price:</strong> $' . number_format($regular/100, 2) . '<br />';
    }
  }
} //End of get_price() function.

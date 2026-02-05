<?php
// 1. Set custom handler
set_error_handler(function($no, $msg) {
    echo "<b>Custom Alert:</b> $msg";
});

// 2. Trigger an error (Undefined Variable)
echo $x;
?>

### Output:

<!-- `Custom Alert: Undefined variable $x` -->

### How it works:
<!-- 
1. **`set_error_handler(...)`**: Tells PHP to ignore its default error reporter and use our function instead.
2. **`$no` & `$msg**`: These capture the Error Number and Error Message automatically.
3. **`echo $x;`**: Since `$x` is not defined, it triggers a warning, which our handler catches immediately. -->
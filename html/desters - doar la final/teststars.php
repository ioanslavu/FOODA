<!DOCTYPE html>

<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
<span class="stars">1</span>

<script>
$.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).html());
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = val * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}
	
$(function() {
    $('span.stars').stars();
});
</script>

</body>
</html>

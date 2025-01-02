<?php
function accent_shortcode($atts, $content = null) {
    return '<span class="text-relacje-color-accent">' . $content . '</span>';
}

add_shortcode('accent', 'accent_shortcode');
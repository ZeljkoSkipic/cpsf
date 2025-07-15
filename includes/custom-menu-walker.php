<?php
class CustomMenuWalker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
		// Check if the item should open in a new tab
        $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

        $output .= "<li class='" .  implode(" ", (array) $item->classes) . "'>";
        $output .= '<a href="' . esc_url($item->url) . '"' . $target . '>';
        $output .= $item->title;
        $output .= '</a>';
        if (in_array('menu-item-has-children', (array) $item->classes)) {
            $output .= '<span class="sub-menu-trigger"><svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.47949 1L7.47949 7L13.4795 1" stroke="#29353B" stroke-width="1.92" stroke-linecap="round" stroke-linejoin="round"/></svg></span>';
        }
    }
}

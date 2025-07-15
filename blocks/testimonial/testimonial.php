<?php

$padding = get_field_object('padding');
$style = get_field_object('testimonial_style');

$class = 'st_block st_testimonial';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

if ( ! empty( $style ) ) {
    $class .=  ' ' . $style['value'];
}

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container st_testimonial_content">
		<div class="open_quote">
			<svg width="80" height="63" viewBox="0 0 80 63" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.763 0.000392914H16.7952V21.9844C28.6911 24.1587 37.5547 35.2715 37.5547 48.5585V62.5703H0.00104904V14.9785C0.00104904 6.76471 6.29888 0.000392914 13.763 0.000392914ZM31.4901 56.5307V48.8001C31.4901 37.6873 23.5596 28.5072 13.763 28.024H10.9639V7.00628C8.16491 8.45578 6.06562 11.5964 6.06562 15.2201V56.5307H31.4901Z" fill="#009FC3"/><path d="M56.2083 0.000392914H59.2406V21.9844C71.1364 24.1587 80 35.2715 80 48.5585V62.5703H42.4464V14.9785C42.4464 6.76471 48.7442 0.000392914 56.2083 0.000392914ZM73.7022 56.5307V48.8001C73.7022 37.6873 65.7716 28.5072 55.975 28.024H53.176V7.00628C50.377 8.45578 48.2777 11.3548 48.2777 15.2201V56.5307H73.7022Z" fill="#009FC3"/></svg>
		</div>
		<div class="testimonial_content">
			<?php echo wp_kses_post( get_field('content') ); ?>
		</div>
		<div class="testimonial_person">
			<?php echo wp_kses_post( get_field('person') ); ?>
		</div>
		<div class="testimonial_person_position">
			<?php echo wp_kses_post( get_field('position') ); ?>
		</div>
		<div class="close_quote">
			<svg width="80" height="63" viewBox="0 0 80 63" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M66.237 62.5699L63.2047 62.5699L63.2047 40.5859C51.3089 38.4116 42.4453 27.2988 42.4453 14.0118L42.4453 0L79.999 6.80059e-06L79.9989 47.5918C79.9989 55.8056 73.7011 62.5699 66.237 62.5699ZM48.5099 6.03957L48.5099 13.7702C48.5099 24.883 56.4404 34.0632 66.237 34.5463L69.0361 34.5463L69.0361 55.564C71.8351 54.1145 73.9344 50.974 73.9344 47.3502L73.9344 6.03957L48.5099 6.03957Z" fill="#009FC3"/><path d="M23.7917 62.5699L20.7594 62.5699L20.7594 40.5859C8.86357 38.4116 -4.60849e-06 27.2988 -2.36542e-06 14.0118L0 0L37.5536 6.80058e-06L37.5536 47.5918C37.5536 55.8056 31.2558 62.5699 23.7917 62.5699ZM6.2978 6.03957L6.2978 13.7702C6.2978 24.883 14.2284 34.0632 24.025 34.5463L26.824 34.5463L26.824 55.564C29.623 54.1145 31.7223 51.2155 31.7223 47.3502L31.7223 6.03957L6.2978 6.03957Z" fill="#009FC3"/></svg>
		</div>
	</div>
</section>

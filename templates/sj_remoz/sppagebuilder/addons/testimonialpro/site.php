<?php

defined ('_JEXEC') or die('resticted aceess');

AddonParser::addAddon('sp_testimonialpro','sp_testimonialpro_addon');
AddonParser::addAddon('sp_testimonialpro_item','sp_testimonialpro_item_addon');

function sp_testimonialpro_addon($atts, $content){

	extract(spAddonAtts(array(
		'autoplay'=>'',
		'arrows'=>'',
		"class"=>'',
		), $atts));

	$carousel_autoplay = ($autoplay)?'data-sppb-ride="sppb-carousel"':'';

	$output  = '<div class="sppb-carousel sppb-testimonial-pro sppb-slide ' . $class . ' " ' . $carousel_autoplay . '>';

	$output .= '<div class="sppb-carousel-inner">';
	$output .= AddonParser::spDoAddon($content);
	$output	.= '</div>';

	if($arrows) {
		$output	.= '<a class="left sppb-carousel-control" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
		$output	.= '<a class="right sppb-carousel-control" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>';
	}
	
	$output .= '</div>';

	return $output;

}

function sp_testimonialpro_item_addon( $atts ){

	extract(spAddonAtts(array(
		"title"=>'',
		"avatar"=>'',
		"avatar_style"=>'',
		'message'=>'',
		"url"=>'',
		), $atts));

	$output   = '<div class="sppb-item">';
	$output  			.= '<div class="sppb-testimonial-message">' . $message . '</div>';
	$title = '<strong class="pro-client-name">'. $title .'</strong>';
	

	$output  			.= '<div class="item-avatar">';

	if($avatar) $output .= '<div class="item-image"><img class="sppb-img-responsive sppb-avatar '. $avatar_style .'" src="'. $avatar .'" alt=""></div>';		
	$output  			.= '<div class="item-info">';
	if($title) $output 	.= '<div class="sppb-testimonial-client">' . $title . '</div>';
	if($url) $output 	.= '<div class="pro-client-url">'. $url .'</div>';
	$output 			.= '</div>';

	$output  			.= '</div>';

		
	$output 			.= '</div>';

	return $output;

}
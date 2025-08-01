"use strict";

jQuery(document).ready(function ($) {
  // Mobile navigation

  $(".menu-toggle").click(function () {
    $("#primary-menu").fadeToggle();
    $(this).toggleClass('menu-open');
  });

  // Sub Menu Trigger

  $(".sub-menu-trigger").click(function () {
    $(this).parent().toggleClass('sub-menu-open');
    $(this).siblings(".sub-menu").slideToggle();
  });

  // Mega Menu Dropdown
  $(".grants_mm_trigger, .grants_mega_menu").hover(function () {
    $("body").addClass('grants_mega_menu-open');
  });
  $(".grants_mm_trigger, .grants_mega_menu").on('mouseleave', function () {
    $('body').removeClass('grants_mega_menu-open');
  });
  $(".contribute_mm_trigger, .contribute_mega_menu").hover(function () {
    $("body").addClass('contribute_mega_menu-open');
  });
  $(".contribute_mm_trigger, .contribute_mega_menu").on('mouseleave', function () {
    $('body').removeClass('contribute_mega_menu-open');
  });
  $(".stories_mm_trigger, .stories_mega_menu").hover(function () {
    $("body").addClass('stories_mega_menu-open');
  });
  $(".stories_mm_trigger, .stories_mega_menu").on('mouseleave', function () {
    $('body').removeClass('stories_mega_menu-open');
  });
  $(".about_mm_trigger, .about_mega_menu").hover(function () {
    $("body").addClass('about_mega_menu-open');
  });
  $(".about_mm_trigger, .about_mega_menu").on('mouseleave', function () {
    $('body').removeClass('about_mega_menu-open');
  });
});
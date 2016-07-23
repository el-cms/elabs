// Page loader script
// http://bootdey.com/snippets/view/page-loader
jQuery(window).load(function () {
  // Loader
  $("#page-loader").delay(400).fadeOut("slow");
  // Wrapper for big images
  $(".card-content img").each(function (i, e) {
    $e = $(e);
    if ($e.height() > 300) {
      $e.parent().addClass('img-cropped-wrapper');
    }
  });
  // Resize images
  $('.img-cropped-wrapper').click(function () {
    $(this).toggleClass('in');
  });
});
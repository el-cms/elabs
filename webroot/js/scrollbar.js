// Configuration
var scrollSpeed = 100; //miliseconds
var scrollLength = 10; //pixels

/**
 * Scrolling function
 * 
 * @param string button jQuery selector of the triggered button
 * @param string target jQuery selector of the element to move
 * @param string direction Left or Right
 */
function scroll(button, target, direction) {
  var sLength = scrollLength;
  var scrollValue;
  var $button=$(button);
  var $target=$(target);
  // Define scrolling direction
  if (direction === 'right') {
    scrollValue = '+=';
  } else {
    scrollValue = '-=';
  }

  // Attach timer and start scrolling
  var timer = window.setInterval(function() {
    $target.animate({
      scrollLeft: scrollValue + sLength
    }, scrollSpeed, 'linear');
    // Accelerate slowly
    sLength += 3;
  }, scrollSpeed);

  // Bind out event : detach timer
  $button.bind('mouseout', function() {
    clearInterval(timer);
    // Unbind this event
    $button.unbind('mouseout');
  });
}
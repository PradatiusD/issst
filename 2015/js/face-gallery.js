  (function hoverMatchImg ($){

    var $container = $('#container');
    var $items     = $container.find('.item');

    // Remove Duplicates
    var images = [];

    $items.each(function(){
      var $this = $(this);

      if ($this.is('aside')) {
        
        var src = $this.find('img').attr('src');

        if (images.indexOf(src) === -1){
          images.push(src);
        } else {
          $this.remove();
        }
      }
    });


    // Shuffle all items
    // Have to requery DOM
    $items = $container.find('.item');

    while ($items.length) {
      $container.append($items.splice(Math.floor(Math.random() * $items.length), 1)[0]);
    }


    // Now start isotope
    $container
      .removeClass('invisible')
      .addClass('animated fade-up-in')
      .isotope();

  })(jQuery);
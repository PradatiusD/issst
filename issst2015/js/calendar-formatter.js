(function($){

  function resortTableByTimeThenTrack($table) {

    var $trs = $table.find('tbody').find('tr');

    var sortedTable = $trs.sort(function(a,b) {

      var $a = $(a);
      var $b = $(b);

      var aClass = $a.attr('class');
      var bClass = $b.attr('class');

      var aStartTime = $a.find('td').first().data('start-time');
      var bStartTime = $b.find('td').first().data('start-time');

      if (aStartTime < bStartTime) {
        return -1;
      }
      else if (aStartTime > bStartTime){
        return 1;
      }
      else {
        if(aClass < bClass) return -1;
        if(aClass > bClass) return 1;
        return 0;
      }

      return 0;
    });

    $table.find('tbody').empty().append(sortedTable);
  } 

  $.fn.removeFirstTd = function() {
    this.find('td').first().remove();
  };

  function updateRowSpansForSimilarEvents ($table) {
    
    var $trs = $table.find('tr');

    $trs.each(function (index){

      var $this = $(this);
      var thisClass = $(this).attr('class');

      if(!$this.hasClass('track-')) {

        var $nextRow = $this.next();

        if($nextRow.hasClass(thisClass) && $this.find('td').length === 3) {
          $this.find('td').first().attr('rowspan','4');
          $this.find('td').first().find('aside').removeClass('hidden');
          $nextRow.removeFirstTd();
          $nextRow.next().removeFirstTd();
          $nextRow.next().next().removeFirstTd();
        }
      }
    });
  }

  $('.issst-2015-program').each(function (index) {
    var $thisTable = $(this);
    resortTableByTimeThenTrack($thisTable);
    updateRowSpansForSimilarEvents($thisTable);
  });

})(jQuery);
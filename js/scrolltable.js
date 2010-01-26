;(function($) {

$.fn.scrolltable = function(options) {
  var settings = jQuery.extend({
    thead_height: 50,
    tbody_height: 400
  }, options);

  var table = $(this);
  
  var newtable = $('<div></div>');
  
  newtable.html('<table cellpadding="0" cellspacing="0" style="width:100%" class="table scroll"><tbody>' + table.find('tbody').html() + '</tbody></table>');
  table.find('tbody').remove();
  
  table.find('thead tr').css('height', settings.thead_height);
  table.find('thead tr th').css('height', settings.thead_height);
  table.css('height', settings.thead_height);
  
  var thead = table.find('thead');
  
  newtable.find('tbody').css('height', settings.tbody_height);
  newtable.css('height', settings.tbody_height)
    .css('overflow-y', 'scroll')
    .css('overflow-x', 'hidden')
    .css('padding', '1px');
  
  var tbody = newtable.find('tbody');
  //tbody.children('tr').css('display', 'block');
  
  var ths = thead.find('tr th');
  var trs = tbody.find('tr');
  trs.each(function(j){
    var tds = $(trs[j]).find('td');
    ths.each(function(i){
      $(tds[i]).css('width', $(ths[i]).width());
    });
  });
  table.parent().append(newtable);
};

})(jQuery);
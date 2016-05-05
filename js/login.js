$(window, document, undefined).ready(function() {

  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');

  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');

    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');

  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
  	$(this).removeClass('is-active');
  });


  $("#kupovina").submit(function(e) {

    $.ajax({
      type: "POST",
      url: "shopform.php",
      data: $("#kupovina").serialize(),
      success: function(data)
      {

        data = JSON.parse(data);
        if (data.status == "OK")
          $("#MsgCnt").html("<h4>Proizvod uspješno kupljen</h4>");
        else
          $("#MsgCnt").html("<h4>" + data.message + "</h4>");

        $("#MsgOK").modal('show');

      }
    });


    e.preventDefault(); // avoid to execute the actual submit of the form.
  });
  $("#frm_dodavanje_").submit(function(e) {
    var data = new FormData(jQuery('#frm_dodavanje')[0]);
    k.append ("ugovor", jQuery('#frm_dodavanje')[0].files[0]);
    $.ajax({
      type: "POST",
      url: "addSupplier.php",
      processData: false,
      data: data,
      success: function(data)
      {
        alert (data);
        data = JSON.parse(data);
        if (data.status == "OK")
          $("#MsgCnt").html("<h4>Dobavljač uspješno dodan!</h4><br><h5><a href='../managerSuppliers.php'>Nazad</a> </h5>");
        else
          $("#MsgCnt").html("<h4>" + data.message + "</h4>");

        $("#MsgOK").modal('show');

      }
    });


    e.preventDefault(); // avoid to execute the actual submit of the form.
  });
});


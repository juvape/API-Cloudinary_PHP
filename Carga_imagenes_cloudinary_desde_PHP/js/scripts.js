

function select_type()
{
  var type = $('#type').val();

  if (type == "top")
  {
    $('#oculto').hide('low');
  }

  if (type == "bottom")
  {
    $('#oculto').show('low');
  }

  if (type == "set")
  {
    $('#oculto').show('low');
  }

  if (type == "cut")
  {
    $('#oculto').hide('low');
  }

}

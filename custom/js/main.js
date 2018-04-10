/* - - - - - - - - - - - - - - - - - - - - -
SETUP
- - - - - - - - - - - - - - - - - - - - - */

$(document).ready(function(){
  jumbo_top_margin();
  startCountDown();
})



/* - - - - - - - - - - - - - - - - - - - - -
FUNCTIONS
- - - - - - - - - - - - - - - - - - - - - */


// jumbo_top_margin

function jumbo_top_margin()
{
  var navbar = $('#mainNav');
  var jumbotron = $('#jumbo-box');
  jumbotron.css("margin-top", navbar.outerHeight());
}

// countdown

function countdown(i)
{
  if (parseInt(i.innerHTML)<=1)
  {
    location.href = 'index.php';
  }
  i.innerHTML = parseInt(i.innerHTML)-1;
}

// startCountDown

function startCountDown()
{
  var counter = document.getElementById('counter');
  if(counter.innerHTML.length)
  {
    setInterval(function(){ countdown(counter); }, 1000);
  }
}

$('.ajaxBtn').click(function()
{
  console.log("ciao");
  var state = 0;

  if($(this).hasClass('active'))
  {
    state = 1;
  }

  if($(this).hasClass('inactive'))
  {
    state = 0;
  }

  $.ajax({
    url: 'update.php',
    data: {
      'sensor_id': $(this).val(),
      'state': state
    }
  })
  .done(function(response){
    $('#sensors-box').html(response);
  })
})

// JavaScript Document//Scroll2LoadMore
$(document).ready(function(){
 
 var limit = 10;
 var start = 0;
 var action = 'inactive';
 var id = document.getElementById("uid").value;
 function load_data(limit, start, id)
 {
  $.ajax({
   url:"../inc/fetch_probiz.php",
   method:"POST",
   data:{limit:limit, start:start, id:id},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<!--<button type='button' class='btn btn-info'>No Data Found</button>-->");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<!--<button type='button' class='btn btn-warning'>Please Wait....</button>-->");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_data(limit, start, id);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_data(limit, start, id);
   }, 2000);
  }
 });
 
});
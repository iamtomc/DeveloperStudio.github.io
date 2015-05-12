window.onload = function()
{
    $.ajax({
  url: 'http://api.randomuser.me/?results=6',
  dataType: 'json',
  success: function(data){
    console.log(data);
    
    for (var i = 1; i <= 6; i++) {
    	$("#name"+i).text(capitalizeFirstLetter(data.results[i-1].user.name.first));
  		$("#image"+i).attr('src', data.results[i-1].user.picture.medium);
    };
  }
});


    
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

$(function() {
    
    $("h2")
        .wrapInner("<span>")

    $("h2 br")
        .before("<span class='spacer'>")
        .after("<span class='spacer'>");

});
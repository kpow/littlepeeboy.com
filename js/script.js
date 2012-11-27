/* Author:

*/
$(function() 
{

$(".load").click(function()
	{
	
		$.getJSON("/ajax/data.js",function(data)
		{
				$.each(data.posts, function(i,data){
					var div_data ="<p><a href='"+data.url+"'>"+data.title+"</a></p>";
						
					$(div_data).appendTo("#showme");
				});
			}
			
		);
		
		
		return false;
	});


});







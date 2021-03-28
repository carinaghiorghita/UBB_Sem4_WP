$(document).ready(function(){
    
    var picWidth = 200;
    var totalWidth = 1600;
    var poz = 0;        
    var popupDiv = document.getElementById("popup-background");
    var popupImg = document.getElementById("popup-image");

    $("li").each(function() {  
            $(this).css("left",poz);     
            poz += picWidth; 
    });

    $("img").click(function(){
       var img = $(this).attr('src');
       popupDiv.style.display = 'block';
       popupImg.src = img; 
       $("li").clearQueue();
       $("li").stop(); 
    });

    popupImg.onclick = function() {
    popupDiv.style.display = 'none';  
    slide();
    } 

    function slide() {
        $("li").animate({"left":"+=15px"}, 'fast', repeat);
    }

    function repeat() {
        var left = $(this).parent().offset().left + $(this).offset().left;
        if (left >= totalWidth) {
            $(this).css("left",left - totalWidth);
        }
        slide();
    }

    slide();
});
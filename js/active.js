jQuery(document).ready(function(){
	jQuery("body").mCustomScrollbar({
		theme:"dark-thick",
        scrollButtons:{
          enable:true
        },
        //scrollInertia: 0, //scroll speed
        mouseWheel:{ scrollAmount: 250 },
        autoHideScrollbar: true,
        //autoExpandScrollbar: true, // it will bold on hover or drag
        //alwaysShowScrollbar: true,
        //snapAmount: 10,
        //mouseWheel: true,
        keyboard:{ enable: false }
	});
})
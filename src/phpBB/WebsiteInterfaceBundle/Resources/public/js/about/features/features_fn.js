/* Features page jQuery functions
 *  by Adam Reyher (AdamR) 2011
 *  Not for redistribution
 */

/* Functions */
function featuresHash() {
	var hashValue = window.location.hash.toString().split('#')[1];
	
	if ($("a[name='" + hashValue + "']").length != 0 && hashValue.length != 0) {
		$("a[name='" + hashValue + "']").closest("div.feature-item-content").removeClass("unselected");
		$("a[name='" + hashValue + "']").closest("div.feature-item-content").addClass("selected");
		$("a[name='" + hashValue + "']").closest(".features-item-content").toggle();
		location.hash = '#' + hashValue;
	}
}

$(document).ready(function(){
	$(".features-item-content").hide();
	featuresHash();
	$(".features-item-head").click(function() {
		if($(this).hasClass("unselected")){
			$(this).removeClass("unselected");
			$(this).addClass("selected")
			}else{
			if($(this).hasClass("selected")) {
				$(this).removeClass("selected");
				$(this).addClass("unselected")
			}
		}
		$(this).parent().children(".features-item-content").toggleFadeSlide(300)
	});
	$(".expandall").show();
	$(".expandall span").text("Expand all");
	var a=false;
	$(".expandall span").click(function(){
	if(a==false) {
		$(".features-item-content").hide().toggleFadeSlide(300);
		a=true;
		$(".expandall span").text("Collapse all");
		$(".features-item-head").removeClass("unselected").addClass("selected")
		} 
		else {
		$(".features-item-content").show().toggleFadeSlide(300);
		a=false;
		$(".expandall span").text("Expand all");
		$(".features-item-head").removeClass("selected").addClass("unselected")
	}
});

$("span.feature-collapse").before('<img src="/theme/images/features/sm-arrow-up.gif" alt="Collapse" class="floatleft collapse" />');
	$("span.feature-collapse").show();
	$("span.feature-collapse").click(function() {
	$(this).parent().toggleFadeSlide(300);
	$(this).parent().parent().children(".features-item-head").removeClass("selected").addClass("unselected")
});

$("span.define-gpl").qtip({
	content:"What does this mean? Quite simply, you can use phpBB for whatever purpose you wish provided 1) You keep our copyright in the source and 2) If you distribute the code, it's also released under the GPLv2.",
	style:{
		fontSize:11,
		lineHeight:1.2,
		name:"cream"
	},
	position:{
		corner:{
			target:"topMiddle",
			tooltip:"bottomLeft"
		}
	}
});

$("span.define-hash").qtip({
	content:"Think of hashing as one-way encryption. There's no way to get the original text via decryption, so it's much safer.",
	style:{
		fontSize:11,
		lineHeight:1.2,
		name:"cream"
	},
	position:{
		corner:{
			target:"topMiddle",
			tooltip:"bottomLeft"
		}
	}
});

$("span.define-captcha").qtip({
	content:'CAPTCHA stands for "<strong>C</strong>ompletely <strong>A</strong>utomated <strong>P</strong>ublic <strong>T</strong>uring test to tell <strong>C</strong>omputers and <strong>H</strong>umans <strong>A</strong>part." Weird name, awesomely effective.',
	style:{
		fontSize:11,
		lineHeight:1.2,
		name:"cream"
	},
	position:{
		corner:{
			target:"topMiddle",
			tooltip:"bottomLeft"
		}
	}
});

$("span.define-utf8").qtip({
	content:"UTF-8 stands for Universal Character Set Trasformation Format - 8-bit.",
	style:{
		fontSize:11,
		lineHeight:1.2,
		name:"cream"
	},
	position:{
		corner:{
			target:"topMiddle",
			tooltip:"bottomLeft"
		}
	}
})
});
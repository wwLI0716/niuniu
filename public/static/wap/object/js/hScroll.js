(function() {
	function hScroll(options) {
		var self = this;
		//$.extend(defaults, options);
		self = Object.assign(self, {
			nav1: '',
			nav2: '',
			check: ''
		}, options);
		self.init();
	}

	hScroll.prototype = {
		init: function() {
			var self = this,
				arr = [],
				kdiv = $(self.nav2);
			for(var i = 0; i < kdiv.length; i++) {
				arr.push($(kdiv[i]).offset().top-105);
			}
			self.sctopFun(arr);
			$(window).scroll(function(e) {
				self.sctopFun(arr);
			});
			$(self.nav1).click(function(e) {
				$('body,html').animate({
					scrollTop: arr[$(this).index()] + 'px'
				});
			});
		},
		sctopFun: function(arr) {
			var self = this;
			var scrollTop = document.body.scrollTop || document.documentElement.scrollTop || window.pageYOffset;
			var keys = 0, flag = true;
			for(var i = 0; i < arr.length; i++) {
				keys++;
				if(flag) {
					if(scrollTop >= arr[arr.length - keys] - $('.x12.nav-list')[0].offsetTop) {
						$(self.nav1).eq(arr.length - keys).addClass(self.checkClass).siblings().removeClass(self.checkClass);
						flag = false;
					} else {
						flag = true;
					}
				}
			}
		}
	}
	window.hScroll = hScroll;
}());
// jPaginate Plugin for jQuery - Version 0.3
// by Angel Grablev for Enavu Web Development network (enavu.com)
// Dual license under MIT and GPL :) enjoy
/*

To use simply call .paginate() on the element you wish like so:
$("#content").jPaginate(); 

you can specify the following options:
items = number of items to have per page on pagination
next = the text you want to have inside the text button
previous = the text you want in the previous button
active = the class you want the active paginaiton link to have
pagination_class = the class of the pagination element that is being generated for you to style
minimize = minimizing will limit the overall number of elements in the pagination links
nav_items = when minimize is set to true you can specify how many items to show
cookies = if you want to use cookies to remember which page the user is on, true by default
position = specify the position of the pagination, possible options: "before", "after", or "both"
equal = implements an equal height main element by using the highest possible element use true false
offset = unfortunately calculating heights with javascript isn't always 100% accurate, so please use this value to make it perfect :) its defaultly set to 50

*/
(function($){
    $.fn.jPaginate = function(options) {
        var defaults = {
            items: 4,
            next: "Next",
            previous: "Previous",
            active: "active",
            pagination_class: "pagination",
            minimize: false,
            nav_items: 6,
			cookies: true,
			position: "after",
			equal: false,
			offset: 50
        };
        var options = $.extend(defaults, options);

        return this.each(function() {
            // object is the selected pagination element list
            obj = $(this);
            // this is how you call the option passed in by plugin of items
            var show_per_page = options.items;
            //getting the amount of elements inside parent element
            var number_of_items = obj.children().size();
            //calculate the number of pages we are going to have
            var number_of_pages = Math.ceil(number_of_items/show_per_page);
            
			//create the pages of the pagination
            var array_of_elements = [];
            var numP = 0;
            var nexP = show_per_page;
			
			var height = 0;
			var max_height = 0;
            //loop through all pages and assign elements into array
            for (i=1;i<=number_of_pages;i++)
            {    
                array_of_elements[i] = obj.children().slice(numP, nexP);
				
				if (options.equal) {	
					obj.children().slice(numP, nexP).each(function(){
						height += $(this).outerHeight(); 
					});
					if (height > max_height) max_height = height;
					height = 0;
				}
				
                numP += show_per_page;
                nexP += show_per_page;
            }
			if (options.equal) {	
				max_height += options.offset;
				obj.css({"height":max_height});
			}
			
			
            // display first page and set first cookie
			if (options.cookies == true) {
				if (get_cookie("current")) {
					showPage(get_cookie("current"));
					createPagination(get_cookie("current"));
				} else {
					set_cookie( "current", "1");
					showPage(get_cookie("current"));
					createPagination(get_cookie("current"));
				}
			} else {
				showPage(1);
				createPagination(1);
			}
            //show selected page
            function showPage(page) {
                obj.children().hide();
                array_of_elements[page].show();
            }
            
            // create the navigation for the pagination 
            function createPagination(curr) {
                var start, items = "", end, nav = "";
                start = "<ul class='"+options.pagination_class+"'>";
                var previous = "<li><a class='goto_previous' href='#'>"+options.previous+"</a></li>";
                var next = "<li><a class='goto_next' href='#'>"+options.next+"</a></li>";
				var previous_inactive = "<li><a class='inactive'>"+options.previous+"</a></li>";
                var next_inactive = "<li><a class='inactive'>"+options.next+"</a></li>";
                end = "</ul><br clear='all' />"
                var after = number_of_pages - options.after + 1;
                var pagi_range = paginationCalculator(curr);
				for (i=1;i<=number_of_pages;i++)
                {
                    if (options.minimize == true) {
						var half = Math.ceil(number_of_pages/2)
                    	if (i >= pagi_range.start && i <= pagi_range.end) {
							if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        	else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
						} else if (curr <= half) {
							if (i >= (number_of_pages - 2)) {
								if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        		else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
							} 
						} else if (curr >= half) {
							if (i <= 2) {
								if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        		else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
							}
						}
                    } else {
                        if (i == curr) { items += '<li><a class="'+options.active+'" title="'+i+'">'+i+'</a></li>';} 
                        else { items += '<li><a href="#" class="goto" title="'+i+'">'+i+'</a></li>';}
                    }
                }
                if (curr != 1 && curr != number_of_pages) {
                    nav = start + previous + items + next + end;
                } else if (number_of_pages == 1) {
					nav = start + previous_inactive + items + next_inactive + end;
				} else if (curr == number_of_pages){
                    nav = start + previous + items + next_inactive + end;
                } else if (curr == 1) {
                    nav = start + previous_inactive + items + next + end;
                }
				if (options.position == "before") {
					obj.before(nav);
				} else if (options.position == "after") {
					obj.after(nav);
				} else {
					obj.after(nav);
					obj.before(nav)
				}
                
            }
			
			/* code to handle cookies */
			/* code to handle cookies */
			function set_cookie(c_name,value)
			{
				var expiredays = 999;
				var exdate=new Date();exdate.setDate(exdate.getDate()+expiredays);document.cookie=c_name+"="+escape(value)+
((expiredays==null)?"":";expires="+exdate.toUTCString());
			}
			function get_cookie(c_name)
			{
				if(document.cookie.length>0)
				{c_start=document.cookie.indexOf(c_name+"=");if(c_start!=-1)
				{c_start=c_start+c_name.length+1;c_end=document.cookie.indexOf(";",c_start);if(c_end==-1)c_end=document.cookie.length;return unescape(document.cookie.substring(c_start,c_end));}}
				return"";
			}
            
			function paginationCalculator(curr)  {
				var half = Math.floor(options.nav_items/2);
				var upper_limit = number_of_pages - options.nav_items;
				var start = curr > half ? Math.max( Math.min(curr - half, upper_limit), 0 ) : 0;
				var end = curr > half?Math.min(curr + half + (options.nav_items % 2), number_of_pages):Math.min(options.nav_items, number_of_pages);
				return {start:start, end:end};
			}
			
            // handle click on pagination 
            $(".goto").live("click", function(e){
                e.preventDefault();
                showPage($(this).attr("title"));
				set_cookie( "current", $(this).attr("title"));
                $(".pagination").remove();
                createPagination($(this).attr("title"));
            });
            $(".goto_next").live("click", function(e) {
                e.preventDefault();
                var act = "."+options.active;
                var newcurr = parseInt($(".pagination").find(".active").attr("title")) + 1;
                set_cookie( "current", newcurr);
				showPage(newcurr);
                $(".pagination").remove();
                createPagination(newcurr);
            });
            $(".goto_previous").live("click", function(e) {
                e.preventDefault();
                var act = "."+options.active;
                var newcurr = parseInt($(".pagination").find(".active").attr("title")) - 1;
				set_cookie( "current", newcurr);
                showPage(newcurr);
                $(".pagination").remove();
                createPagination(newcurr);
            });
        });
        
       
    };
})(jQuery);
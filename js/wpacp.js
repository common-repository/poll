/*!
 * jQuery Expander Plugin v1.4
 *
 * Copyright 2011, Karl Swedberg
 * Dual licensed under the MIT and GPL licenses (just like jQuery):
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
*/
(function(d){d.expander={version:"1.4",defaults:{slicePoint:100,preserveWords:true,widow:4,expandText:"read more",expandPrefix:"&hellip; ",expandAfterSummary:false,summaryClass:"summary",detailClass:"details",moreClass:"read-more",lessClass:"read-less",collapseTimer:0,expandEffect:"fadeIn",expandSpeed:250,collapseEffect:"fadeOut",collapseSpeed:200,userCollapse:true,userCollapseText:"read less",userCollapsePrefix:" ",onSlice:null,beforeExpand:null,afterExpand:null,onCollapse:null}};d.fn.expander=function(k){function H(a,
c){var g="span",h=a.summary;if(c){g="div";if(w.test(h)&&!a.expandAfterSummary)h=h.replace(w,a.moreLabel+"$1");else h+=a.moreLabel;h='<div class="'+a.summaryClass+'">'+h+"</div>"}else h+=a.moreLabel;return[h,"<",g+' class="'+a.detailClass+'"',">",a.details,"</"+g+">"].join("")}function I(a){var c='<span class="'+a.moreClass+'">'+a.expandPrefix;c+='<a href="#">'+a.expandText+"</a></span>";return c}function x(a,c){if(a.lastIndexOf("<")>a.lastIndexOf(">"))a=a.slice(0,a.lastIndexOf("<"));if(c)a=a.replace(J,
"");return a}function y(a,c){c.stop(true,true)[a.collapseEffect](a.collapseSpeed,function(){c.prev("span."+a.moreClass).show().length||c.parent().children("div."+a.summaryClass).show().find("span."+a.moreClass).show()})}function K(a,c,g){if(a.collapseTimer)z=setTimeout(function(){y(a,c);d.isFunction(a.onCollapse)&&a.onCollapse.call(g,false)},a.collapseTimer)}var u="init";if(typeof k=="string"){u=k;k={}}var r=d.extend({},d.expander.defaults,k),L=/^<(?:area|br|col|embed|hr|img|input|link|meta|param).*>$/i,
J=/(&(?:[^;]+;)?|\w+)$/,M=/<\/?(\w+)[^>]*>/g,A=/<(\w+)[^>]*>/g,B=/<\/(\w+)>/g,w=/(<\/[^>]+>)\s*$/,N=/^<[^>]+>.?/,z;k={init:function(){this.each(function(){var a,c,g,h,l,n,v,C=[],s=[],o={},p=this,f=d(this),D=d([]),b=d.meta?d.extend({},r,f.data()):r,O=!!f.find("."+b.detailClass).length,q=!!f.find("*").filter(function(){return/^block|table|list/.test(d(this).css("display"))}).length,t=(q?"div":"span")+"."+b.detailClass,E="span."+b.moreClass,P=b.expandSpeed||0,m=d.trim(f.html());d.trim(f.text());var e=
m.slice(0,b.slicePoint);if(!d.data(this,"expander")){d.data(this,"expander",true);d.each(["onSlice","beforeExpand","afterExpand","onCollapse"],function(i,j){o[j]=d.isFunction(b[j])});e=x(e);for(summTagless=e.replace(M,"").length;summTagless<b.slicePoint;){newChar=m.charAt(e.length);if(newChar=="<")newChar=m.slice(e.length).match(N)[0];e+=newChar;summTagless++}e=x(e,b.preserveWords);h=e.match(A)||[];l=e.match(B)||[];g=[];d.each(h,function(i,j){L.test(j)||g.push(j)});h=g;c=l.length;for(a=0;a<c;a++)l[a]=
l[a].replace(B,"$1");d.each(h,function(i,j){var F=j.replace(A,"$1"),G=d.inArray(F,l);if(G===-1){C.push(j);s.push("</"+F+">")}else l.splice(G,1)});s.reverse();if(O){c=f.find(t).remove().html();e=f.html();m=e+c;a=""}else{c=m.slice(e.length);if(c===""||c.split(/\s+/).length<b.widow)return;a=s.pop()||"";e+=s.join("");c=C.join("")+c}b.moreLabel=f.find(E).length?"":I(b);if(q)c=m;e+=a;b.summary=e;b.details=c;b.lastCloseTag=a;if(o.onSlice)b=(g=b.onSlice.call(p,b))&&g.details?g:b;q=H(b,q);f.html(q);n=f.find(t);
v=f.find(E);n.hide();v.find("a").unbind("click.expander").bind("click.expander",function(i){i.preventDefault();v.hide();D.hide();o.beforeExpand&&b.beforeExpand.call(p);n.stop(false,true)[b.expandEffect](P,function(){n.css({zoom:""});o.afterExpand&&b.afterExpand.call(p);K(b,n,p)})});D=f.find("div."+b.summaryClass);b.userCollapse&&!f.find("span."+b.lessClass).length&&f.find(t).append('<span class="'+b.lessClass+'">'+b.userCollapsePrefix+'<a href="#">'+b.userCollapseText+"</a></span>");f.find("span."+
b.lessClass+" a").unbind("click.expander").bind("click.expander",function(i){i.preventDefault();clearTimeout(z);i=d(this).closest(t);y(b,i);o.onCollapse&&b.onCollapse.call(p,true)})}})},destroy:function(){if(this.data("expander")){this.removeData("expander");this.each(function(){var a=d(this),c=d.meta?d.extend({},r,a.data()):r,g=a.find("."+c.detailClass).contents();a.find("."+c.moreClass).remove();a.find("."+c.summaryClass).remove();a.find("."+c.detailClass).after(g).remove();a.find("."+c.lessClass).remove()})}}};
k[u]&&k[u].call(this);return this};d.fn.expander.defaults=d.expander.defaults})(jQuery);

//Add Color Polls Specific JS
jQuery(document).ready(function() {
	wpacp_bindBehaviors(this);	
});

var wpacp_bindBehaviors=function(scope) {
		
		jQuery('form.wpacp input.pollq_title, form.wpacp .pollq_desc', scope).formtips({
				tippedClass: 'defaultValue'
		});
	
		jQuery('span.qdesc', scope).expander({
			slicePoint: wpacpL10n.maxchar,
			widow: 2,
			expandText: wpacpL10n.read_more,
			expandPrefix: '',
			userCollapseText: '[^]'
		});
		
		jQuery('.showaq', scope).click(function(){
			var pollid_arr=jQuery(this).attr('id').split('-');
			var pollid=pollid_arr[1];
			jQuery('#wpacp-'+pollid+' .wpacp-addq').fadeIn(900);
		});
		
		jQuery('.wpacp-addq .addq', scope).click(function(){
			var pollid_arr=jQuery(this).attr('id').split('-');
			var pollid=pollid_arr[1];
			var polltitle=jQuery('#wpacp-'+pollid+' .pollq_title').val();
			var polldesc=jQuery('#wpacp-'+pollid+' .pollq_desc').val();
			var qi=jQuery('#wpacp-'+pollid+' .wpacpqi').val();
			
			jQuery.post( wpacpL10n.submit_url , {'addq' : pollid, 'title': polltitle, 'desc': polldesc, 'qi': qi, '_ajax_nonce':wpacpL10n.ajn} , function(data){
				jQuery('#wpacp-'+pollid+' .wpacp-addq').fadeOut(900);
				jQuery(data).appendTo('#wpacp-'+pollid+' .poll-wrap').hide().fadeIn(900);
				jQuery('#wpacp-'+pollid+' .wpacpqi').val(qi++);
			});	

			return false;
		});
		
		
		jQuery('.wpacp_vote', scope).click(function(){
			var pollid_arr=jQuery(this).attr('id').split('-');
			var pollid=pollid_arr[1];
			var count_arr=jQuery('#wpacp-'+pollid+' .cvpcount').val().split('-');
			var qcount=count_arr[0];
			var acount=count_arr[1];
			var qarr=[];
			var aarr=[];
			var aid='0';
			var qid='0';
			
			jQuery('.wpacp-error').remove();
			var mandatoryError='0';
			for(var i=0;i<qcount;i++){
				qid=jQuery('#qid'+i).val();
				var qidrel;
				var qidobj=jQuery(':input[name=aqid'+qid+']', jQuery('#wpacp-'+pollid) );
				qidrel=qidobj.attr('rel');
				if( qidrel=='required' && !qidobj.is(':checked') ){
					jQuery('<div class="wpacp-error">'+wpacpL10n.mandatory_question+'</div>').appendTo('.qdesc'+qid);
					mandatoryError='1';
				}
				
				qarr.push( qid  );		
				aid=jQuery(':input[name=aqid'+qid+']:checked', jQuery('#wpacp-'+pollid)).val();
				if(typeof aid != 'undefined'){
					aarr.push( aid );
				}
				else{
					aid='0';
					aarr.push('0');
				}
			}
			if(mandatoryError=='1'){
				mandatoryError='0';
				return false;
			}
			
			jQuery.post( wpacpL10n.submit_url , {'pollid' : pollid, 'qarr': qarr, 'aarr' : aarr, 'qcount': qcount, 'acount': acount, '_ajax_nonce':wpacpL10n.ajn} , function(data){
				jQuery('#wpacp-'+pollid).html(data).hide().fadeIn(900);
				jQuery('#wpacp-'+pollid+' span.qdesc').expander({
					slicePoint: wpacpL10n.maxchar,
					widow: 2,
					expandText: wpacpL10n.read_more,
					expandPrefix: '',
					userCollapseText: '[^]'
				});
			});	

			return false;
		});
	};

var wpacp_bindResultBehaviors=function(scope) {
		jQuery('form.wpacp input.pollq_title, form.wpacp .pollq_desc', scope).formtips({
				tippedClass: 'defaultValue'
		});
		jQuery('span.qdesc', scope).expander({
				slicePoint: wpacpL10n.maxchar,
				widow: 2,
				expandText: wpacpL10n.read_more,
				expandPrefix: '',
				userCollapseText: '[^]'
		});
		
		jQuery('.showaq', scope).click(function(){
			var pollid_arr=jQuery(this).attr('id').split('-');
			var pollid=pollid_arr[1];
			jQuery('#wpacp-'+pollid+' .wpacp-addq').fadeIn(900);
		});
		
		jQuery('.wpacp-addq .addq', scope).click(function(){
			var pollid_arr=jQuery(this).attr('id').split('-');
			var pollid=pollid_arr[1];
			var polltitle=jQuery('#wpacp-'+pollid+' .pollq_title').val();
			var polldesc=jQuery('#wpacp-'+pollid+' .pollq_desc').val();
			var qi=jQuery('#wpacp-'+pollid+' .wpacpqi').val();
			
			jQuery.post( wpacpL10n.submit_url , {'raddq' : pollid, 'title': polltitle, 'desc': polldesc, 'qi': qi, '_ajax_nonce':wpacpL10n.ajn} , function(data){
				jQuery('#wpacp-'+pollid).html(data).hide().fadeIn(900);
				wpacp_bindResultBehaviors('#wpacp-'+pollid);
			});	

			return false;
		});
}

function wpacp_results_click(obj){
		var pollid_arr=jQuery(obj).attr('id').split('-');
		var pollid=pollid_arr[1];
		
		jQuery.post( wpacpL10n.submit_url , {'rid' : pollid, '_ajax_nonce':wpacpL10n.ajn } , function(data){
			jQuery('#wpacp-'+pollid).html(data).hide().fadeIn(900);
			wpacp_bindResultBehaviors('#wpacp-'+pollid);
		});	

		return false;
}

function wpacp_vote_button_click(obj){
		var pollid_arr=jQuery(obj).attr('id').split('-');
		var pollid=pollid_arr[1];
		
		jQuery.post( wpacpL10n.submit_url , {'vid' : pollid, '_ajax_nonce':wpacpL10n.ajn } , function(data){
			jQuery('#wpacp-'+pollid).html(data).hide().fadeIn(900);
			wpacp_bindBehaviors('#wpacp-'+pollid);
		});	

		return false;
}